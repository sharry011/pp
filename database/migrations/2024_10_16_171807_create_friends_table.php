<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
         
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
