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
            $table->string('address',200);
            $table->text('note')->nullable();
            $table->double('shipping_fee')->default(0);
            $table->enum('payment',['cod','onl']);
            $table->string('promotion_code',30)->nullable();
            // $table->enum('status',[0,1,2,3,4,5,6])->comment("0: cancelled, 1: received, 2: processing, 3: packing, 4: waiting for shipping, 5: being transported, 6: delivered")->default(1);
            $table->enum('status',['cancelled','received','processing','being transported','delivered'])->default('received');
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
