<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('contacts')) {
            Schema::rename('contacts', 'contact_us');
        }
        Schema::table('contact_us', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('email')->comment('The company name of the contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn('company_name');
        });
        if (Schema::hasTable('contact_us')) {
            Schema::rename('contact_us', 'contacts');
        }
    }
};
