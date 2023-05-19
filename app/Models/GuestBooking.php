<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBooking extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'bed_space',
        'user_id',
        'hostel_room_id',
        'check_in_date',
        'check_out_date',
        'amount_paid',
        'balance'
        //payment method
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function hostelRoom(){
        return $this->belongsTo(HostelRoom::class);
    }

    use HasFactory;
}
