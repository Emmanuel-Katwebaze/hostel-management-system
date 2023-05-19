<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;
class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    function run()
    {
        $data = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+1 555-123-4567',
                'gender' => 'male',
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane.doe@example.com',
                'phone' => '+1 555-987-6543',
                'gender' => 'female',
            ],
        ];

        Tenant::insert($data);
    }
}









