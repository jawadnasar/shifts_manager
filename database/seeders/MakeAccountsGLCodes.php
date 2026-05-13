<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakeAccountsGLCodes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('glcodes')->insertOrIgnore([
            /**
             * 1-40 ASSETS
             * 41-60 LIABILITIES
             * 61-80 INCOME
             * 81-99 EXPENSES
             */
            ['actype' => 1, 'name' => 'CASH', 'basetype'=> 'ASSETS'],
            ['actype' => 2, 'name' => 'BANK', 'basetype'=>'ASSETS'], 
            ['actype' => 3, 'name' => 'FIXED ASSETS', 'basetype'=>'ASSETS'],
            ['actype' => 4, 'name' => 'OTHER CURRENT ASSETS', 'basetype'=>'ASSETS'], 
            ['actype' => 5, 'name' => 'Clients/Customers', 'basetype'=>'ASSETS'],                
            ['actype' => 41, 'name' => 'OTHER LIABILITIES', 'basetype' => 'LIABILITIES'],
            ['actype' => 42, 'name' => 'Employees', 'basetype' => 'LIABILITIES'],
            ['actype' => 61, 'name' => 'INCOME', 'basetype' => 'INCOME'],
            ['actype' => 81, 'name' => 'ADMINISTRATIVE EXPENSES', 'basetype' => 'INDIRECT/EXPENSES'],
            ['actype' => 91, 'name' => 'SALE PROMOTION EXPENSES', 'basetype' => 'DIRECT/EXPENSES'],
            // ['actype' => , 'name' => '', 'gltype' => ''], l.  
        ]);
    }
}
