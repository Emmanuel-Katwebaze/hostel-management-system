<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret'),
            'is_admin' => true, // Set the is_admin value to true for the sample admin user
        ]);

        $this->call([
            HostelRoomTypeSeeder::class,
            HostelRoomSeeder::class,
            StaffSeeder::class,
            TenantSeeder::class,
            HostelBookingSeeder::class,
            FacilitySeeder::class,
            ExpenseSeeder::class,
            // other seeders
        ]);
    }
}
