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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('no_order')->unique();
            $table->unsignedBigInteger('id_user')->nullable()->index();
            $table->unsignedBigInteger('id_user_address')->nullable()->index();
            $table->text('note')->nullable();
            // Amount
            $table->double('total_price')->nullable()->default(0);
            $table->double('total_weight')->nullable()->default(0);
            $table->double('discount_amount')->nullable()->default(0);
            $table->double('shipping_cost')->nullable()->default(0);
            $table->double('payment_amount')->nullable()->default(0);
            $table->string('tracking_number')->nullable();
            $table->date('receipt_date')->nullable();
            $table->unsignedBigInteger('id_status')->nullable()->index();
            $table->string('status_message')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user_address')->references('id')->on('user_address')->onDelete('set null')->onUpdate('set null');
            $table->foreign('id_status')->references('id')->on('status')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};
