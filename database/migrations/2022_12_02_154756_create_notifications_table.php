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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("comment_id")->nullable();
            $table->unsignedBigInteger("like_id")->nullable();
            $table->unsignedBigInteger("rating_id")->nullable();
            $table->unsignedBigInteger("vote_by_id")->nullable();
            $table->text("message")->nullable();
            $table->boolean("has_read")->default(0);
            $table->timestamps();
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')
                ->onDelete('cascade');
            $table->foreign('like_id')->references('id')->on('likes')
                ->onDelete('cascade');
            $table->foreign('rating_id')->references('id')->on('ratings')
                ->onDelete('cascade');
            $table->foreign('vote_by_id')->references('id')->on('vote_bies')
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
        Schema::dropIfExists('notifications');
    }
};
