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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("to");
            $table->unsignedBigInteger("by");
            $table->integer("rating");
            $table->timestamps();
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign('to')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('by')->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
};
