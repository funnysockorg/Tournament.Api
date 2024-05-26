<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('discord_id', 255)
                ->nullable(false)
                ->unique();
            $table->string('name', 255)
                ->nullable(false);
            $table->string('avatar_hash')
                ->nullable();
            $table->string('access_token', 255)
                ->nullable(false);
            $table->string('refresh_token', 255)
                ->nullable(false);
            $table->dateTime('token_expires_in')
                ->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_data');
    }
};
