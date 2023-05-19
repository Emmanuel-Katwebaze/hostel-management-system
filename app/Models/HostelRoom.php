<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoom extends Model
{
    protected $table = 'hostel_rooms';
    protected $primaryKey = 'id';
    protected $fillable = ['room_number', 'floor_level', 'bed_space', 'status', 'hostel_room_type_id' ];

    public function hostelRoomType(){
        return $this->belongsTo(HostelRoomType::class);
    }

    public function hostelBooking(){
        return $this->hasMany(HostelRoomBooking::class);
    }

    public function guestBooking(){
        return $this->hasOne(GuestBooking::class);
    }

    use HasFactory;
}
