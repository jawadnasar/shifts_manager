<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Users_InitialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'fname' => 'Jawad Nasar',
                'sname' => 'Shah',
                'email' => 'jawadnasar7886@gmail.com',
                'email_verified_at' => now(),
                'user_type' => 'admin',
                'password' => '$2y$12$Cb3EH3oIy3sR3Ol30ui35u1i3KjRtNGvaYNo6dXZuQYKs3sM2gFtW',
                'remember_token' => Str::random(10),
                'pri_setprivileges' => 1,
                'pri_addreceipt' => 1,
                'pri_editreceipt' => 1,
                'pri_addjournal' => 1,
                'pri_editjournal' => 1,
                'pri_addpayment' => 1,
                'pri_editpayment' => 1,
                'pri_addexpenses' => 1,
                'pri_editexpenses' => 1,
                'pri_adduser' => 1,
            ],
            [
                'fname' => 'Admin',
                'sname' => 'Admin',
                'email' => 'admin@shiftsmanager.com',
                'email_verified_at' => now(),
                'user_type' => 'admin',
                'password' => '$2y$12$ZQqmyFFz154MB7x8rKEC4.YIJc8ZS9qI2wC6bWz.4AhBvvJ5KV1AO',
                'remember_token' => Str::random(10),
                'pri_setprivileges' => 1,
                'pri_addreceipt' => 1,
                'pri_editreceipt' => 1,
                'pri_addjournal' => 1,
                'pri_editjournal' => 1,
                'pri_addpayment' => 1,
                'pri_editpayment' => 1,
                'pri_addexpenses' => 1,
                'pri_editexpenses' => 1,
                'pri_adduser' => 1,
            ],
        ];

        foreach ($users as $userData) {
            if (!User::where('email', $userData['email'])->exists()) {
                User::create($userData);
            }
        }
    }
}
?>