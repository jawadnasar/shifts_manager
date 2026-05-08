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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('user_rate', 8, 2); // Hourly pay rate for user
            $table->decimal('client_rate', 8, 2); // Hourly billing rate to client
            $table->unsignedBigInteger('client_id')->nullable(); // Optional client association
            $table->decimal('total_hours', 8, 2)->default(0);
            $table->decimal('total_pay_user', 10, 2)->default(0); // Total pay to user
            $table->decimal('total_billed_client', 10, 2)->default(0); // Total billed to client
            $table->date('shift_date');
            $table->timestamps();

            $table->foreign('client_id')->references('accountid')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};