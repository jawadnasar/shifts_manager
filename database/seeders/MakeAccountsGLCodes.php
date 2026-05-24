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
            ['actype' => 1, 'name' => 'Cash/Banks', 'basetype'=> 'ASSETS'],
            ['actype' => 2, 'name' => 'Stock', 'basetype'=>'ASSETS'], 
            ['actype' => 3, 'name' => 'Fixed Assets', 'basetype'=>'ASSETS'],
            ['actype' => 4, 'name' => 'Other Current Assets', 'basetype'=>'ASSETS'],
            ['actype' => 5, 'name' => 'Debitors/Customers', 'basetype'=>'ASSETS'], 
            ['actype' => 6, 'name' => 'Creditors/Suppliers', 'basetype'=>'ASSETS'],                
            ['actype' => 7, 'name' => 'Fixed Assets', 'basetype'=>'ASSETS'],
            ['actype' => 8, 'name' => 'OTHER LIABILITIES', 'basetype' => 'LIABILITIES'],
            ['actype' => 51, 'name' => 'INCOME', 'basetype' => 'INCOME'],
            ['actype' => 61, 'name' => 'ADMINISTRATIVE EXPENSES', 'basetype' => 'INDIRECT/EXPENSES'],
            ['actype' => 71, 'name' => 'SALE PROMOTION EXPENSES', 'basetype' => 'DIRECT/EXPENSES'],
            // ['actype' => , 'name' => '', 'gltype' => ''], l.  
        ]);
    }
}
