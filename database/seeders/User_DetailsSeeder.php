<?php

namespace Database\Seeders;

use App\Models\User_Details;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class User_DetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User_Details::factory()->count(1)->create(); // Create 50 records
    }
}
