<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('invoice')) {
            Schema::create('invoice', function (Blueprint $table) {
                $table->id('transid');
                $table->date('date');
                $table->bigInteger('debitac')->nullable()->unsigned();
                $table->bigInteger('user_id')->nullable()->unsigned();
                $table->float('total_amount', 10, 2)->default(0);
                $table->float('received_amount', 10, 2)->default(0);
                $table->float('balance', 10, 2)->default(0);             // balance=Total-received -> actually balance is the amount remaining for the patient to pay usually in case of inpatient
                $table->text('details')->nullable();
                $table->boolean('cancelled')->default(false);
                $table->date('cancelledon')->nullable();
                $table->bigInteger('created_by')->unsigned();              // Foreign Key
                $table->bigInteger('updated_by')->unsigned()->nullable();      // Foreign Key
                $table->timestamps();                

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('updated_by')->references('id')->on('users');
                $table->foreign('debitac')->references('accountid')->on('accounts');
            });
        }

        if (!Schema::hasTable('inv_data')) {
            Schema::create('inv_data', function (Blueprint $table) {
                $table->unsignedBigInteger('transid')->index();                     // Foreign Key
                $table->bigInteger('item_id')->nullable()->unsigned();      // Foreign key
                $table->float('sale');
                $table->float('qty');
                $table->text('details')->default('')->nullable();

                $table->foreign('transid')->references('transid')->on('invoice');
                $table->foreign('item_id')->references('item_id')->on('item_mast');
            });
        }
    }
};
