<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->enum('role', ['U', 'CM'])->nullable();
            $table->enum('status', ['A', 'B', 'P'])->default('A');
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('user_clubManagerID')->nullable();
            $table->unsignedBigInteger('user_categoryID')->nullable();
            $table->foreign('user_categoryID')->references('category_id')->on('player_categories');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
