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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_brand')->nullable()->index();
            $table->unsignedBigInteger('id_category')->nullable()->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->double('weight')->nullable()->default(0)->comment('gram');
            $table->double('price')->nullable()->default(0);
            $table->double('discount')->nullable()->default(0);
            $table->text('description')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->boolean('published')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('id_brand')->references('id')->on('brand')->onDelete('set null')->onUpdate('set null');
            $table->foreign('id_category')->references('id')->on('category')->onDelete('set null')->onUpdate('set null');
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
};
