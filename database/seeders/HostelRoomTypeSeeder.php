<?php

namespace Database\Seeders;

use App\Models\HostelRoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class HostelRoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HostelRoomType::create([
            'room_type' => 'Unassigned',
            'room_price' => 0,
            'room_capacity' => 0,
            'room_description' => 'Rooms that are yet to be assigned to a category',
            'room_type_photo' => '/storage/images/other.jpg'
        ]);


        HostelRoomType::create([
            'room_type' => 'Single',
            'room_price' => 100000,
            'room_capacity' => 1,
            'room_description' => 'A single room with one bed',
            'room_type_photo' => '/storage/images/single-room.jpg'
        ]);

        HostelRoomType::create([
            'room_type' => 'Double',
            'room_price' => 150000,
            'room_capacity' => 2,
            'room_description' => 'A double room with two beds',
            'room_type_photo' => '/storage/images/double-room.jpg'

        ]);

        HostelRoomType::create([
            'room_type' => 'Shared',
            'room_price' => 120000,
            'room_capacity' => 1,
            'room_description' => 'A single room with a large bed',
            'room_type_photo' => '/storage/images/shared-room.jpg'

        ]);
    }
}
