<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emails_sent', function (Blueprint $table) {
            $table->id();
            $table->string('to_email');
            $table->string('cc_email')->nullable();
            $table->string('subject');
            $table->string('attachments')->nullable();
            $table->text('email_body');
            $table->bigInteger('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
