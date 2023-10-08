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
            $table->text('mobile_number')->after('email')->default(0);
            $table->text('phone_number')->after('mobile_number')->default(0);
            $table->string('address')->after('phone_number')->nullable();
            $table->string('country')->after('address')->nullable();
            $table->string('state')->after('country')->nullable(); 
            $table->string('city')->after('state')->nullable();
            $table->string('lendmark')->after('city')->nullable();
            $table->string('profile_image')->after('lendmark')->nullable();
            $table->string('description')->after('profile_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mobile_number');
            $table->dropColumn('phone_number');
            $table->dropColumn('address');
            $table->dropColumn('country');
            $table->dropColumn('state'); 
            $table->dropColumn('city');
            $table->dropColumn('lendmark');
            $table->dropColumn('profile_image');
            $table->dropColumn('description');
        });
    }
};
