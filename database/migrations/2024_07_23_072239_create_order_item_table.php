<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order')->nullable()->index();
            $table->unsignedBigInteger('id_product')->nullable()->index();
            $table->unsignedBigInteger('id_product_variant')->nullable()->index();
            $table->double('qty')->nullable()->default(0);
            $table->double('sub_total')->nullable()->default(0);
            $table->double('weight')->nullable()->default(0);
            $table->double('discount')->nullable()->default(0);
            $table->double('total')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('id_order')->references('id')->on('order')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_product')->references('id')->on('product')->onDelete('set null')->onUpdate('set null');
            $table->foreign('id_product_variant')->references('id')->on('product_variant')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item');
    }
};
