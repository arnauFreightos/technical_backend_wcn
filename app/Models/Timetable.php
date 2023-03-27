<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Timetable extends Model
{
    use HasFactory;

    public function slots(){
        $maxSlot = $this->classroom->hoursPerSlot;
        $startTime = $this->start_time;
        $endTime = $this->end_time;
        

        $slots = array();
        $slots = $this->truncateSlots($startTime, $endTime, $maxSlot, $slots); 

        return $slots;

    }

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }


    public function truncateSlots($startTime, $endTime, $maxSlot, $slots){ 
        
        $slot = new Slot;
        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);
        $diffInHours = $endTime->diffInHours($startTime);
       
        $slot->day_of_week = $this->day_of_week;
        $slot->start_time = $startTime;
        $slot->timetable = $this;

        $startOfWeek = Carbon::now()->startOfWeek();
        $dayOfWeek = $startOfWeek->next($this->day_of_week);
        $date = $dayOfWeek->format('Y-m-d');
        $slot->date = $date;

        if($diffInHours <= $maxSlot){
            $slot->end_time = $endTime;  
            array_push($slots, $slot);
            return $slots;         
        }
        else{
            $nextStartTime = $startTime->addHour($maxSlot);
            $slot->end_time = $nextStartTime;  
            array_push($slots, $slot);
            $slots = $this->truncateSlots($nextStartTime, $endTime, $maxSlot, $slots);
            return $slots;
        }

    }

    public function getSlotsByDateTime($date, $startTime, $am_slots){

        $slots = $this->slots();
        $valid_slots = array();
        
        foreach($slots as $slot){
            if($slot->isInRangeTime($date, $startTime, $am_slots)){
                array_push($valid_slots, $slot);
            }
        }    
        return $valid_slots; 
    }
    


  
}
