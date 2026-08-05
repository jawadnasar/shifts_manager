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
        if (Schema::hasTable('user_details')) {
            Schema::table('user_details', function (Blueprint $table) {
                $table->string('bank_name')->nullable()->change();
                $table->string('bank_address')->nullable()->change();
                $table->string('account_holder_name')->nullable()->change();
                $table->string('sort_code')->nullable()->change();
                $table->string('account_number')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('user_details')) {
            Schema::table('user_details', function (Blueprint $table) {
                $table->string('bank_name')->nullable(false)->change();
                $table->string('bank_address')->nullable(false)->change();
                $table->string('account_holder_name')->nullable(false)->change();
                $table->string('sort_code')->nullable(false)->change();
                $table->string('account_number')->nullable(false)->change();
            });
        }
    }
};
