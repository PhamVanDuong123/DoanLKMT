<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',60);
            $table->string('username',30)->unique()->nullable();
            $table->string('email',60)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',100);
            $table->string('phone',12)->unique()->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('address',200)->nullable();
            $table->string('avatar',150)->nullable();
            $table->enum('permission',[1,2,3])->comment('1: boss, 2: admin, 3:sale')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
