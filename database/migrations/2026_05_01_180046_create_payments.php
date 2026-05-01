<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id('transid');
                $table->date('date');
                $table->bigInteger('creditac')->nullable()->unsigned();
                $table->bigInteger('debitac')->nullable()->unsigned();
                $table->text('details')->nullable();
                $table->float('amount', 10, 2)->default('0.00');
                $table->string('cheque_no', 30)->nullable();
                $table->date('cheque_date')->nullable();
                $table->bigInteger('user_id')->unsigned()->nullable(); // Foreign Key
                $table->bigInteger('created_by')->unsigned(); // Foreign Key
                $table->bigInteger('updated_by')->unsigned()->nullable(); // Foreign Key
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('updated_by')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};