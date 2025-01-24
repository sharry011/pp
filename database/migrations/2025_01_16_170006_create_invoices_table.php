<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('client_name'); // Name of the client
            $table->string('project_name'); // Name of the project
            $table->string('category'); // Category of the invoice
            $table->text('description'); // Detailed description of the invoice
            $table->decimal('price', 10, 2); // Price of the invoice (decimal with 2 decimal places)
            $table->timestamps(); // Created and updated timestamp fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}


