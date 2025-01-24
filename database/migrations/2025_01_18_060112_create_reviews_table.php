<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('name'); // Name of the reviewer
            $table->string('email')->unique(); // Email address (unique)
            $table->string('phone'); // Phone number
            $table->tinyInteger('rating')->unsigned(); // Rating (1 to 5 stars)
            $table->text('review_details'); // Detailed review
            $table->enum('status', ['unchecked', 'approved'])->default('unchecked'); // Review status
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
