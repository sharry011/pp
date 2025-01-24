<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalInfosTable extends Migration
{
    public function up()
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();  // Phone number field
            $table->string('password');  // Password field
            $table->string('intro_heading');
            $table->text('intro_detail');
            $table->string('cv')->nullable();  // CV field
            $table->string('image')->nullable();  // Image field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personal_infos');
    }
}
