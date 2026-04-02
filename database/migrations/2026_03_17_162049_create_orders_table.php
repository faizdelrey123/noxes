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
        Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('address_id')->constrained()->onDelete('cascade');
    $table->string('shipping'); // jne / jnt
    $table->string('payment'); // qris / bank
    $table->integer('total');
    $table->string('proof')->nullable(); // bukti pembayaran
    $table->timestamps();
    $table->string('order_code')->unique();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
