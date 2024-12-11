<?php

namespace Database\Seeders;

use App\Models\User_Details;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_DetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //User_Details::factory()->count(1)->create(); // Create 50 records

        $users = [
            [
                'fname' => 'Test',
                'sname' => 'User',
                'user_type' => 'admin', // Dummy admin entry
                'email' => 'test@example.com',
                'password' => 'admin1234',
            ],
            
        ];

        foreach ($users as $user) {
            // Check if user already exists
            $existingUser = DB::table('users')
                ->where('email', $user['email'])
                ->first();

            if (!$existingUser) {
                DB::table('users')->insert([
                    'fname' => $user['fname'],
                    'sname' => $user['sname'],
                    'user_type' => $user['user_type'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
