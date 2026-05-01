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
        if (!Schema::hasTable('accounts')) {
            Schema::create('accounts', function (Blueprint $table) {
                $table->id('accountid');
                $table->string('name');
                $table->integer('actype')->unsigned();
                $table->boolean('is_active')->default(true);
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('company')->nullable();
                $table->string('address')->nullable();
                $table->string('details')->nullable();
                $table->bigInteger('created_by')->unsigned();                   // Foreign Key
                $table->bigInteger('updated_by')->unsigned()->nullable();      // Foreign Key
                $table->timestamps();

                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('updated_by')->references('id')->on('users');
            });
        }

        if (!Schema::hasTable('glcodes')) {
            Schema::create('glcodes', function (Blueprint $table) {
                $table->integer('actype')->unsigned()->unique();
                $table->string('name');
                $table->string('basetype')->nullable();
            });
        }

        if (!Schema::hasTable('acctran')) {
            Schema::create('acctran', function (Blueprint $table) {
                $table->bigInteger('transid');
                $table->string('vtype');
                $table->date('date');
                $table->bigInteger('accountid');
                $table->decimal('debit', 16, 4)->default('0.00');
                $table->decimal('credit', 16, 4)->default('0.00');
                $table->text('details')->default('');
                $table->Integer('actype');
                $table->bigInteger('user_id')->nullable()->unsigned();               // Foreign Key
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

                $table->foreign('user_id')->references('id')->on('users');
            });
        }

        if (!Schema::hasTable('receipts')) {
            Schema::create('receipts', function (Blueprint $table) {
                $table->id('transid');
                $table->date('date');
                $table->bigInteger('debitac');
                $table->bigInteger('creditac');
                $table->text('details')->default('');
                $table->bigInteger('user_id')->nullable()->unsigned();
                $table->decimal('amount', 16, 4);
                $table->bigInteger('created_by')->unsigned();              // Foreign Key
                $table->bigInteger('updated_by')->unsigned()->nullable();      // Foreign Key
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('updated_by')->references('id')->on('users');
            });
        }

        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id('transid');
                $table->date('date');
                $table->bigInteger('debitac');
                $table->bigInteger('creditac');
                $table->text('details')->default('');
                $table->bigInteger('user_id')->nullable()->unsigned();
                $table->decimal('amount', 16, 4);
                $table->bigInteger('created_by')->unsigned();              // Foreign Key
                $table->bigInteger('updated_by')->unsigned()->nullable();      // Foreign Key
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
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('glcodes');
        Schema::dropIfExists('acctran');
        Schema::dropIfExists('receipts');
        Schema::dropIfExists('payments');
    }
};
