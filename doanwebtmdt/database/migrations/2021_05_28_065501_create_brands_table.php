<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name',30)->unique();
            $table->string('phone',12)->unique();
            $table->string('email',60)->unique();
            $table->string('address',200);
            $table->string('country',40);
            $table->string('logo',150)->nullable();
            $table->string('website',150);
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
        Schema::dropIfExists('brands');
    }
}
