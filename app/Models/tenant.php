<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tenant extends Model
{
    protected $table = 'tenant';
    protected $primaryKey = 'id';
    protected $fillable = [ 'name', 'email', 'phone', 'gender' ];

    public function hostelBooking(){
        return $this->hasMany(HostelBooking::class);
    }
    use HasFactory;
}
