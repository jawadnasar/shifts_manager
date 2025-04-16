<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankDetailsToUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('bank_name')->after('share_code');
            $table->string('bank_address')->after('bank_name');
            $table->string('account_holder_name')->after('bank_address');
            $table->string('sort_code')->after('account_holder_name');
            $table->string('account_number')->after('sort_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn(['bank_name', 'bank_address', 'account_holder_name', 'sort_code', 'account_number']);
        });
    }
}
