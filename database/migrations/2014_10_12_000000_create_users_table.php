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
            $table->string('full_name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone_no')->nullable();
            $table->string('password')->nullable();
            $table->string('country')->nullable();
            $table->string('nationality')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('zodiac')->nullable();
            $table->text('hobbies')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string("google_id")->nullable();
            $table->string("facebook_id")->nullable();
            $table->string("twitter_id")->nullable();
            $table->string("verification_code");
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('block')->default(0);
            $table->string('device_token')->nullable();
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
