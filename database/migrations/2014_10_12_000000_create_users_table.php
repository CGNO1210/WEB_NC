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
            $table->string('login_name')->unique();
            $table->string('password');
            $table->string('user_name');
            $table->string('user_phone');
            $table->string('user_mail');
            $table->boolean("user_isadmin")->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('slug')->unique();
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
