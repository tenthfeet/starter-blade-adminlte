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
        Schema::create(config('table.users'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('isd')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('password');
            $table->unsignedTinyInteger('status');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create(config('table.password_reset_tokens'), function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('table.users'));
        Schema::dropIfExists(config('table.password_reset_tokens'));
    }
};
