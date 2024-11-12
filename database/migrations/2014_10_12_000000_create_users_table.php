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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('role',['admin','vendor','user'])->default('user');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('business_name')->nullable();
            $table->string('shop_url')->nullable();
            $table->string('business_type')->nullable()->commit('retailer,wholesaler');
            $table->string('bussiness_registration_number')->nullable();
            $table->string('address')->nullable();
            $table->string('user_name')->nullable();
            $table->boolean('terms_and_conditions')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
