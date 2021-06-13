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
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name',60);
            $table->string('phone',12);
            $table->string('address',200);
            $table->text('note')->nullable();
            $table->double('shipping_fee')->default(0);
            $table->enum('payment',['cod','onl']);
            $table->unsignedBigInteger('promotion_id');
            $table->double('total');
            $table->enum('status',[0,1,2,3,4,5,6])->comment("0: cancelled, 1: received, 2: processing, 3: packing, 4: waiting for shipping, 5: being transported, 6: received");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
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
