<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('products', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->integer('collection_id');
                    $table->string('color_id');
                    $table->string('product_code');
                    $table->string('product_title');
                    $table->decimal('product_price', 10, 2)->default(0);
                    $table->longText('product_description');
                    $table->string('url')->nullable();
                    $table->longText('product_images');
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
        Schema::dropIfExists('product');
    }
}
