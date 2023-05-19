<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $table->string('category');
        //     $table->string('description');
        //     $table->integer('amount_spent');
        //     $table->date('date_of_expenditure');
        //     $table->timestamps();

        Expense::create([
            'category' => 'Utilities',
            'description' => 'Paid for the hostel electricity bill',
            'amount_spent' => 2000000,
            'date_of_expenditure' => '2023-05-09'
        ]);

        Expense::create([
            'category' => 'Utilities',
            'description' => 'Paid for the hostel electricity bill',
            'amount_spent' => 2000000,
            'date_of_expenditure' => '2023-05-09'
        ]);

        Expense::create([
            'category' => 'Maintenance',
            'description' => 'Repaired the plumbing of certain rooms',
            'amount_spent' => 200000,
            'date_of_expenditure' => '2023-05-09'
        ]);

        Expense::create([
            'category' => 'Maintenance',
            'description' => 'Worked on faulty electrical connections',
            'amount_spent' => 300000,
            'date_of_expenditure' => '2023-05-09'
        ]);

        Expense::create([
            'category' => 'Kitchen equipment',
            'description' => 'Purchase extra kitchen equipment',
            'amount_spent' => 500000,
            'date_of_expenditure' => '2023-05-09'
        ]);

    }




    /*
    Rent or mortgage payments for the property
    Utilities such as electricity, gas, water, and internet
    Property taxes and insurance
    Maintenance and repair costs for the building, including plumbing, electrical, and HVAC systems
    Cleaning supplies and services
    Pest control services
    Bedding and linens for guests
    Furniture and fixtures such as beds, desks, chairs, and lamps
    Kitchen equipment and appliances such as stoves, refrigerators, and microwaves
    Staff salaries and benefits
    Marketing and advertising expenses to attract guests
    Property improvements or renovations
    Laundry services for guest linens and towels
    Security systems and equipment
    Office supplies and equipment for managing bookings and finances.
    */
}

