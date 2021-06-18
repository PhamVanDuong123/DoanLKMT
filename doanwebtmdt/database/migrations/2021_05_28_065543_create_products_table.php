<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',70);
            $table->string('code',100)->nullable();
            $table->unsignedBigInteger('brand_id');
            $table->double('price');
            $table->double('old_price')->nullable();
            $table->string('thumb',150)->nullable();
            $table->integer('inventory_num')->default(0);
            $table->string('short_desc',300);
            $table->text('detail_desc');
            $table->integer('warranty');
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status',['approved','not approved yet'])->default('not approved yet');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
