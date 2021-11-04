<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->string('code',230)->nullable();
            $table->string('short_desc',300);
            $table->text('content');
            $table->unsignedBigInteger('post_category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('thumb',150);
            $table->integer('views')->nullable();
            $table->enum('status',['approved','not approved yet'])->default('not approved yet');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_category_id')->references('id')->on('post_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
