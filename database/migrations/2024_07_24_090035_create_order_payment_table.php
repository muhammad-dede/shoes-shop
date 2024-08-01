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
        Schema::create('order_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order')->nullable()->index();
            $table->unsignedBigInteger('id_bank_account')->nullable()->index();
            $table->date('transfer_date')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('transfer_receipt')->nullable();
            $table->timestamps();

            $table->foreign('id_order')->references('id')->on('order')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_bank_account')->references('id')->on('bank_account')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_payment');
    }
};
