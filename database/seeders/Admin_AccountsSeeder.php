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
                'name' => 'Service Charges',
                'actype' => 51,
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
                'actype' => 8,
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
