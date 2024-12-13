<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adding Some user docuents and make some of them available and some of them like deleted or ignored
     */
    public function up(): void
    {
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id('doc_id');
            $table->bigInteger('user_id')->unsigned();
            // ! national_idcard, security_licence, driving_licence, passport, brp, other etc.
            $table->string('doc_type')
                ->comment('See comment in migration file 2024_12_09_035858_users_documents');
            $table->string('link');
            /**
            ! 
            0. inactive
            1. active
            2. updated
            3. deleted
             */
            $table->tinyInteger('status')->default(1)->comment('See comment in migration file 2024_12_09_035858_users_documents');
            $table->text('details');

            $table->bigInteger('created_by')->unsigned(); // Foreign Key
            $table->bigInteger('updated_by')->unsigned()->nullable(); // Foreign Key
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_documents');
    }
};
