<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
            $table->decimal('price', 8, 2); // Product price
            $table->text('description')->nullable(); // Product description
            $table->year('year_of_purchase')->nullable(); // Year of purchase
            $table->string('category')->nullable();  // Add a category field
            $table->string('image')->nullable(); // Add image column
            $table->boolean('is_available')->default(true); // Set default to true (available)

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}