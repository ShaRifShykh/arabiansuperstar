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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("vote_plan_id");
            $table->unsignedBigInteger("user_id");
            $table->bigInteger("order_id");
            $table->string("payment_status");
            $table->bigInteger("total_amount");
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('vote_plan_id')->references('id')->on('vote_plans')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('orders');
    }
};
