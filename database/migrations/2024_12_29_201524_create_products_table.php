// database/migrations/xxxx_xx_xx_xxxxxx_create_products_table.php

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
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('photo')->nullable();
            $table->boolean('is_auction')->default(false);
            $table->timestamp('auction_start_date')->nullable();
            $table->timestamp('auction_end_date')->nullable();
            $table->boolean('is_negotiable')->default(false);
            $table->decimal('negotiation_price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
