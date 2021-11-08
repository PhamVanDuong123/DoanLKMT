<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('code',30)->unique();
            $table->enum('condition',[1,2])->comment("1: giảm giá theo %, 2: giảm giá tiền");
            $table->integer('number');
            $table->integer('qty');
            $table->date('start_day')->default(now());
            $table->date('end_day');           
            $table->enum('status',['approved','not approved yet'])->comment("approved: được duyệt, not approved yet: chưa được duyệt")->default('not approved yet');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
