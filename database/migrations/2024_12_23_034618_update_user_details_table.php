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
        if(Schema::hasTable('user_details')) {
            Schema::table('user_details', function (Blueprint $table) {
                $table->unsignedBigInteger('birth_place')->nullable()->change();
                $table->unsignedBigInteger('nationality')->nullable()->change();

                $table->foreign('birth_place')->references('id')->on('countries');
                $table->foreign('nationality')->references('id')->on('countries');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
