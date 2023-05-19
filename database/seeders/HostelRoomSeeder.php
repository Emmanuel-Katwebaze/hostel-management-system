<?php

namespace Database\Seeders;

use App\Models\HostelRoom;
use App\Models\HostelRoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HostelRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $unassigned = DB::table('hostel_room_types')
            ->where('room_type', '=', 'Unassigned')
            ->select(['id', 'room_capacity'])
            ->first();


        $single = DB::table('hostel_room_types')
            ->where('room_type', '=', 'Single')
            ->select(['id', 'room_capacity'])
            ->first();

        $double = DB::table('hostel_room_types')
            ->where('room_type', '=', 'Double')
            ->select(['id', 'room_capacity'])
            ->first();

        $shared = DB::table('hostel_room_types')
            ->where('room_type', '=', 'Shared')
            ->select(['id', 'room_capacity'])
            ->first();




        HostelRoom::create([
            'room_number' => 'A101',
            'floor_level' => 'First Floor',
            'bed_space' => $single->room_capacity,
            'status' => 'Available',
            'hostel_room_type_id' => $single->id
        ]);

        HostelRoom::create([
            'room_number' => 'B042',
            'floor_level' => 'Second Floor',
            'bed_space' => $double->room_capacity,
            'status' => 'Available',
            'hostel_room_type_id' => $double->id
        ]);

        HostelRoom::create([
            'room_number' => 'C190',
            'floor_level' => 'Third Floor',
            'bed_space' => $double->room_capacity,
            'status' => 'Available',
            'hostel_room_type_id' => $double->id
        ]);

        HostelRoom::create([
            'room_number' => 'D024',
            'floor_level' => 'Fourth Floor',
            'bed_space' => $shared->room_capacity,
            'status' => 'Available',
            'hostel_room_type_id' => $shared->id
        ]);

        HostelRoom::create([
            'room_number' => 'E805',
            'floor_level' => 'Fifth Floor',
            'bed_space' => $single->room_capacity,
            'status' => 'Available',
            'hostel_room_type_id' => $single->id

        ]);
        HostelRoom::create([
            'room_number' => 'B806',
            'floor_level' => 'Second Floor',
            'bed_space' =>  $double->room_capacity,
            'status' => 'Available',
            'hostel_room_type_id' => $double->id

        ]);
        HostelRoom::create([
            'room_number' => 'C195',
            'floor_level' => 'Third Floor',
            'bed_space' => $shared->room_capacity,
            'status' => 'Available',
            'hostel_room_type_id' => $shared->id

        ]);
        HostelRoom::create([
            'room_number' => 'D803',
            'floor_level' => 'Fourth Floor',
            'bed_space' => $single->room_capacity,
            'status' => 'Available',
            'hostel_room_type_id' => $single->id

        ]);
        HostelRoom::create([
            'room_number' => 'E027',
            'floor_level' => 'Fifth Floor',
            'bed_space' =>  $double->room_capacity,
            'status' => 'Available',
            'hostel_room_type_id' => $double->id

        ]);
        HostelRoom::create([
            'room_number' => 'E803',
            'floor_level' => 'First Floor',
            'bed_space' => $shared->room_capacity,
            'status' => 'Available',
            'hostel_room_type_id' => $shared->id

        ]);
    }
}
