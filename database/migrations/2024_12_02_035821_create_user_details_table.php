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
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->date("dob");
            $table->char('gender', 2);
            /** Disability */
            $table->boolean('is_disabled')->default(false); // Yes/No disability status
            $table->json('disabilities')->nullable(); // Store selected disabilities as a JSON array
            $table->string('phone', 20);
            $table->string('birth_place')->nullable();
            $table->string('nationality')->nullable();
            $table->string('current_address')->nullable();
            $table->string('town')->nullable();
            $table->char('postcode',10)->nullable();
            $table->date('living_since')->nullable();
            $table->char('ni_number', 20)->nullable();
            /** Emergence Contact Details */
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            /** Sia licence Information */
            $table->string('sia_licence_type')->nullable();
            $table->string('sia_licence_number')->nullable();
            $table->string('sia_licence_expiry_date')->nullable();
            /** Driving Licence Information  */
            $table->boolean('driving_licence_present')->nullable()->default(false);
            $table->string('driving_licence_type')->nullable();
            $table->string('driving_licence_number')->nullable();
            $table->boolean('own_vehicle')->nullable()->default(false);
            /** Crimial Background Info */
            $table->boolean('criminal_offence_present')->nullable()->default(false);
            $table->text('criminal_offence_details')->nullable();
            /** Right to work */
            $table->string('share_code')->nullable();


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
        Schema::dropIfExists('user_details');
    }
};
