<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Classroom extends Model
{
    use HasFactory;

    public function timetables(){
        return $this->hasMany(Timetable::class);
    }


    public function getAvailableSlots($timetables) {
        $slots = array();
        foreach($timetables as $tt){
            $maxSlot = $this->hoursPerSlot;
            $startTime = $tt->start_time;
            $endTime = $tt->end_time;
            $slots = $tt->truncateSlots($startTime, $endTime, $maxSlot, $slots); 
        }
        return $slots;
    }

    public function areAvailableSlotsInARow($date, $startTime, $am_slots){

        if(Carbon::parse($date) >= Carbon::today()){
            $timetable = new Timetable;
            $timetable = $this->getTimetableByDateTime($date, $startTime, $am_slots);
            if($timetable != null){
                $slots = $timetable->getSlotsByDateTime($date, $startTime, $am_slots);
                $tof = true;
                foreach($slots as $slot){
                    if($slot->isInRangeTime($date, $startTime, $am_slots) && !$slot->isAvailableSlot()) $tof == false;
                }
                return $tof;

            }
            else return false;
                                    
        }
        else return false; 
    }


    public function getTimetableByDateTime($date, $startTime, $slots){
        $endTime =  Carbon::parse($startTime)->addHours($slots)->format("H:i:s");
        $dayOfWeek = Carbon::parse($date)->dayOfWeek;
        $timetable = $this->timetables
                    ->where('day_of_week', "=", $dayOfWeek)
                    ->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime)
                    ->first();  
                    
        return $timetable;     
    }



    
}
