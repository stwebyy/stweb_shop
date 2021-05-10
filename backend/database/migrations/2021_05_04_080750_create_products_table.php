<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('name');
            $table->unsignedInteger('price');
            $table->unsignedInteger('stock');
            $table->string('description');
            $table->string('image');
            $table->unsignedBigInteger('admin_user_id');
            $table->softDeletes();
            $table->dateTime('created_at', 0)->useCurrent();
            $table->dateTime('updated_at', 0)->useCurrent();

            $table->foreign('admin_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
