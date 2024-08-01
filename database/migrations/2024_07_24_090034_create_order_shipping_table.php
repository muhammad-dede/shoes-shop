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
        Schema::create('order_shipping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order')->nullable()->index();
            $table->string('code_courier')->nullable()->index();
            $table->string('service')->nullable();
            $table->string('description')->nullable();
            $table->string('etd')->nullable();
            $table->double('cost')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('id_order')->references('id')->on('order')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('code_courier')->references('code')->on('courier')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_shipping');
    }
};
