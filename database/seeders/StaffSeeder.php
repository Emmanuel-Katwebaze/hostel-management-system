<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::create([
            'staff_name' => 'John Doe',
            'staff_email' => 'johndoe@example.com',
            'staff_phone' => '1234567890',
            'staff_role' => 'Manager'
        ]);

        Staff::create([
            'staff_name' => 'Jane Doe',
            'staff_email' => 'janedoe@example.com',
            'staff_phone' => '0987654321',
            'staff_role' => 'Supervisor'
        ]);
    }
}

// php artisan make:seeder StaffSeeder
// php artisan db:seed --class=StaffSeeder

