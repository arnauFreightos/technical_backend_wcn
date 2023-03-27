<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
    }

    public function getAvailableClassrooms(){
        
        $classrooms = Classroom::all();
        $data = array();
    
        foreach ($classrooms as $cr) {
            
            $slots = $cr->getAvailableSlots($cr->timetables);
    
            $classroomData = array(
                "name" => $cr->name,
                "capacity" => $cr->capacity,
                "hoursPerSlot" => $cr->hoursPerSlot,
                "slots" => array()
            );
    
            foreach ($slots as $slot) {
                //slot is available when it has slack in his time
                if($slot->isAvailableSlot()){
                    $availableCapacity = $slot->getCapacity();
                    $slotData = array(
                        "startTime" => $slot->start_time->format('H:i'),
                        "endTime" => $slot->end_time->format('H:i'),
                        "date" =>$slot->date,
                        "availableCapacity" => $availableCapacity 
                    );

                    array_push($classroomData['slots'], $slotData);
                }

            }
    
            array_push($data, array("classroom" => $classroomData));
        }
        return response()->json($data);
    }


    public function addBooking(Request $request){
        $date = $request->date;
        $startTime = $request->start_time;
        $amountSlots = $request->slots;
    
        $classroom = new Classroom();
        $classroom = Classroom::where("name", $request->classroom_name)->first();
        if($classroom != null){
    
            if($classroom->areAvailableSlotsinARow($date, $startTime, $amountSlots)){
                $booking = new Booking;
                $booking->date = $date;
                $booking->start_time = $startTime;
                $booking->end_time = Carbon::parse($startTime)->addHours($amountSlots)->format('H:i:s');
                $timetable = $classroom->getTimetableByDateTime($date, $startTime, $amountSlots);                
                $booking->timetable_id = $timetable->id;

                $booking->save();

                $data = [ 
                    'message' => 'Booking generated successfully',
                    'booking' => $booking,
                ];

            }
            else 
                $data = [
                    'message' => 'Oops, unfortunately we could not create the requested booking'
                ];
             
        }
        else 
            $data = [
                "message" => "Classroom doesn't exist."
            ];

        return response()->json($data);
    }
}
