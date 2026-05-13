<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\User;

class Admin_AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            [
                'accountid' => 1000,
                'name' => 'Income',
                'actype' => 61,
                'email' => '',
                'phone' => '',
                'company' => '',
                'address' => '',
                'details' => '',
                'created_by' => User::first()?->id,
            ],
            [
                'accountid' => 1,
                'name' => 'Cash',
                'actype' => 1,
                'email' => '',
                'phone' => '',
                'company' => '',
                'address' => '',
                'details' => '',
                'created_by' => User::first()?->id,
            ], 
            [
                'accountid' => 42,
                'name' => 'Employees',
                'actype' => 42,
                'email' => '',
                'phone' => '',
                'company' => '',
                'address' => '',
                'details' => '',
                'created_by' => User::first()?->id,
            ],
        ];

        foreach ($accounts as $account) {
            Account::updateOrCreate(
                [
                    'accountid' => $account['accountid'],
                ],

                $account,
            );
        }
    }
}
