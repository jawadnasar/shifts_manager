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
        /** Disability */
        if(Schema::hasTable('user_details')) {
            Schema::table('user_details', function (Blueprint $table) {
                $table->boolean('is_disabled')->default(false)->after('ni_number');
                $table->text('disabilities')->nullable()->after('is_disabled');
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
