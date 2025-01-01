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
        Schema::table('users', function (Blueprint $table) {
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('phone_number');
            $table->string('id_number');
            $table->string('id_photo');
            $table->double('monthly_income');
            $table->string('tax_id_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['place_of_birth']);
            $table->dropColumn(['date_of_birth']);
            $table->dropColumn(['phone_number']);
            $table->dropColumn(['id_number']);
            $table->dropColumn(['id_photo']);
            $table->dropColumn(['monthly_income']);
            $table->dropColumn(['tax_id_number']);
        });
    }
};
