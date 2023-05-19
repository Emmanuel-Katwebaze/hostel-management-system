<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $Table = "facilities";
    protected $primaryKey = 'id';
    protected $fillable = ['Facility_Name', 'Description', 'Availability', 'facility_photo' ];

    use HasFactory;
}
