<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Slot extends Model
{
    use HasFactory;

    public function timetable()
    {
        return $this->belongsTo(Timetable::class);
    }


    protected $fillable = ['start_time', 'end_time', 'date'];

    public function getStartTimeAttribute($value)
    {
        return new Carbon($value);
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value->format('H:i');
    }

    public function getEndTimeAttribute($value)
    {
        return new Carbon($value);
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value->format('H:i');
    }

    public function getDate($value)
    {
        return new Carbon($value);
    }

    public function setDate($value)
    {
        $this->attributes['date'] = $value->format('Y:m:d');
    }

    public function getDayOfWeek(){
        return $this->date->format('l');
    }

    public function isAvailableSlot(){
        $availableCapacity = $this->getCapacity();

        if($availableCapacity>0){
            return true;
        }       
        else return false;
    }           

    public function getCapacity(){
          
        $bookings =  $this->timetable->bookings->where('status', true);        
        $overlappedBooking =  $this->timetable->bookings
                ->where('status', true)
                ->where('start_time', '<', $this->end_time->format('H:i:s'))
                ->where('end_time', '>', $this->start_time->format('H:i:s'))
                ->where('date', '=', $this->date);
        
        $count = $overlappedBooking->count();

        $Classroomcapacity = $this->timetable->classroom->capacity;
        $capacity = $Classroomcapacity - $count;
        return $capacity;
    }


    public function isInRangeTime($date, $startTime, $am_slots){
        $endTime =  Carbon::parse($startTime)->addHours($am_slots)->format("H:i:s");
        $dayOfWeek = Carbon::parse($date)->dayOfWeek;

        $tof = false;

        if($date = $this->date){
            if($this->start_time->format("H:i:s") < $endTime && $this->end_time->format("H:i:s") > $startTime) 
            {
                $tof = true;
            }
        }

        return $tof;

    }


}

