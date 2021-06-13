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
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->text('description')->nullable();
            $table->date('start_day')->default(now());
            $table->date('end_day');
            $table->double('percents');
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
