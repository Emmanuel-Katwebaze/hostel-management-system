<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bed;
use Illuminate\Support\Facades\DB;

class BedSeeder extends Seeder
{
    public function run()
    {
        $room1 = DB::table('hostel_rooms')
            ->where('room_number', '=', 'B042')
            ->select('id')
            ->first();

        $room2 = DB::table('hostel_rooms')
            ->where('room_number', '=', 'B042')
            ->select('id')
            ->first();

        $room3 = DB::table('hostel_rooms')
            ->where('room_number', '=', 'C190')
            ->select('id')
            ->first();

        $room4 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'D024')
        ->select('id')
        ->first();

        $room5 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'E805')
        ->select('id')
        ->first();

        $room6 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'B806')
        ->select('id')
        ->first();

        $room7 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'C195')
        ->select('id')
        ->first();

        $room8 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'D803')
        ->select('id')
        ->first();

        $room9 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'E027')
        ->select('id')
        ->first();

        $room10 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'E803')
        ->select('id')
        ->first();

        $room11 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'E027')
        ->select('id')
        ->first();

        $room12 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'B806')
        ->select('id')
        ->first();

        $data = [
            [
                'bed_number' => 'BE1',
                'availability' => 'vacant',
                'hostel_room_id' => $room1->id
            ],
            [
                'bed_number' => 'BE2',
                'availability' => 'vacant',
                'hostel_room_id' => $room2->id
            ],
            [
                'bed_number' => 'BE3',
                'availability' => 'vacant',
                'hostel_room_id' => $room3->id
            ],
            [
                'bed_number' => 'BE4',
                'availability' => 'vacant',
                'hostel_room_id' => $room4->id
            ],
            [
                'bed_number' => 'BE5',
                'availability' => 'vacant',
                'hostel_room_id' => $room5->id
            ],
            [
                'bed_number' => 'BE6',
                'availability' => 'vacant',
                'hostel_room_id' => $room6->id
            ],
            [
                'bed_number' => 'BE7',
                'availability' => 'vacant',
                'hostel_room_id' => $room7->id
            ],
            [
                'bed_number' => 'BE8',
                'availability' => 'vacant',
                'hostel_room_id' => $room8->id
            ],
            [
                'bed_number' => 'BE9',
                'availability' => 'vacant',
                'hostel_room_id' => $room9->id
            ],
            [
                'bed_number' => 'BE10',
                'availability' => 'vacant',
                'hostel_room_id' => $room10->id
            ],
            [
                'bed_number' => 'BE11',
                'availability' => 'vacant',
                'hostel_room_id' => $room11->id
            ],
            [
                'bed_number' => 'BE12',
                'availability' => 'vacant',
                'hostel_room_id' => $room12->id
            ],




        ];
        Bed::insert($data);
    }
}
