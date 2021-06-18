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
            $table->text('description')->nullable();
            $table->date('start_day')->default(now());
            $table->date('end_day');
            $table->double('percents');
            $table->integer('number');
            $table->enum('status',['approved','not approved yet'])->default('not approved yet');
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
