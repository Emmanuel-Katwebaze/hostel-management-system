<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HostelBooking;
use App\Models\HostelRoom;
use Illuminate\Support\Facades\DB;

class HostelBookingSeeder extends Seeder
{
    public function run()
    {

        $tenant1 = DB::table('tenant')
            ->where('email', 'john.smith@example.com')
            ->select('id')
            ->first();
        $hostelRoom1 = HostelRoom::where('room_number', '=', 'A101')
            ->first();

        $hostelRoom2 = HostelRoom::where('room_number', '=', 'B042')
            ->first();

        HostelBooking::create([
            'bed_space' => $hostelRoom1->hostelRoomType->room_capacity,
            'check_in_date' => '2023-05-02',
            'check_out_date' => '2023-05-08',
            'amount_paid' => 150000,
            'balance' => 500000,
            'tenant_id' => $tenant1->id,
            'hostel_room_id' => $hostelRoom1->id,
        ]);


        HostelBooking::create([
            'bed_space' => $hostelRoom2->hostelRoomType->room_capacity,
            'check_in_date' => '2023-05-02',
            'check_out_date' => '2023-05-08',
            'amount_paid' => 750000,
            'balance' => 0,
            'tenant_id' => $tenant1->id,
            'hostel_room_id' => $hostelRoom2->id,
        ]);

        $hostelRoom1->bed_space -= $hostelRoom1->hostelRoomType->room_capacity;
        if ($hostelRoom1->bed_space == 0) {
            $hostelRoom1->status = 'Unavailable';
        }
        $hostelRoom1->save();

        $hostelRoom2->bed_space -= $hostelRoom2->hostelRoomType->room_capacity;
        if ($hostelRoom2->bed_space == 0) {
            $hostelRoom2->status = 'Unavailable';
        }
        $hostelRoom2->save();
    }
}
