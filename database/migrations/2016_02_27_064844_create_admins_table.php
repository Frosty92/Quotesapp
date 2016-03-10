<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
   
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('username')->unique();
            $table->string('name');            
            $table->string('password');
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::drop('admins');
    }
}
