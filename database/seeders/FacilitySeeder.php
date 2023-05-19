<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::create([
            'Facility_Name' => 'Gym',
            'Description' => 'A fancy Gym to fit all your fitness needs',
            'Availability' => 'Available',
            'facility_photo' => '/storage/images/gym.jpg'
        ]);


        Facility::create([
            'Facility_Name' => 'Swimming Pool',
            'Description' => 'A fancy pool to refresh yourself on a hot sunny day',
            'Availability' => 'Under Renovation',
            'facility_photo' => '/storage/images/pool.jpg'
        ]);

        Facility::create([
            'Facility_Name' => 'Restaurant',
            'Description' => 'A fancy restaurant with your local foods',
            'Availability' => 'Available',
            'facility_photo' => '/storage/images/restaurant.jpg'
        ]);

        Facility::create([
            'Facility_Name' => 'Laundry',
            'Description' => 'A public area for doing your laundry',
            'Availability' => 'Available',
            'facility_photo' => '/storage/images/laundry.jpg'
        ]);

    }
}
