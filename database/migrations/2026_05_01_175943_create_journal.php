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
        if (!Schema::hasTable('journal')) {
            Schema::create('journal', function (Blueprint $table) {
                $table->id('transid');
                $table->date('date');
                $table->text('details')->nullable();
                $table->float('debits', 10, 2)->default('0.00');
                $table->float('credits', 10, 2)->default('0.00');
                $table->bigInteger('user_id')->unsigned()->nullable(); // Foreign Key
                $table->bigInteger('created_by')->unsigned();              // Foreign Key
                $table->bigInteger('updated_by')->unsigned()->nullable();      // Foreign Key
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('updated_by')->references('id')->on('users');
            });
        }

        if (!Schema::hasTable('jrndata')) {
            Schema::create('jrndata', function (Blueprint $table) {
                $table->unsignedBigInteger('transid')->index();                     // Foreign Key
                $table->bigInteger('accountid')->nullable()->unsigned();
                $table->text('details')->nullable();
                $table->float('debit', 10, 2)->default('0.00');
                $table->float('credit', 10, 2)->default('0.00');
                $table->integer('actype')->unsigned();

                $table->foreign('transid')->references('transid')->on('journal');
                $table->foreign('accountid')->references('accountid')->on('accounts');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * 
     * Note: We are not dropping the journal and jrndata tables here because they are essential for the system and might contain important data. Instead, we can choose to drop them in a separate migration if needed in the future.
     */ 

    public function down()
    {
        Schema::dropIfExists('jrndata');
        Schema::dropIfExists('journal');
    }
};
