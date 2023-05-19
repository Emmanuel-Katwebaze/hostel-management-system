<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoomType extends Model
{
    protected $table = 'hostel_room_types';
    protected $primaryKey = 'id';
    protected $fillable = ['room_type', 'room_price','room_capacity', 'room_description','room_type_photo'];

    public function hostelRoom(){
        return $this->hasMany(HostelRoom::class);
    }

    use HasFactory;
}
