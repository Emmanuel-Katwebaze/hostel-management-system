<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelBooking extends Model
{
    protected $fillable = [
        'hostel_room_id',
        'tenant_id',
        'bed_space',
        'check_in_date',
        'check_out_date',
        'amount_paid',
        'balance',
        //payment method
    ];
    public function tenant(){
        return $this->belongsTo(tenant::class);
    }
    public function bed(){
        return $this->belongsTo(Bed::class);
    }

    public function hostelRoom(){
        return $this->belongsTo(HostelRoom::class);
    }

    use HasFactory;
}
