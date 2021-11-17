<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('code',30)->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('name',60);
            $table->string('phone',12);
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('ward_id');
            $table->string('address',200);
            $table->text('note')->nullable();
            $table->double('shipping_fee')->default(0);
            $table->enum('payment',['cod','onl']);
            $table->string('promotion_code',30)->nullable();
            $table->enum('status',[1,2,3])->comment("3: cancelled, 1: processing, 2: processed")->default('1');
            //$table->enum('status',['cancelled','received','processing','being transported','delivered'])->default('received');
            $table->string('order_date',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
}
