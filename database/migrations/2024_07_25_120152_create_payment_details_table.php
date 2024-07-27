<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('orderNumber')->nullable();
            $table->string('oid')->nullable()->comment('UID');
            $table->string('status')->nullable();
            $table->string('transectionCode')->nullable();
            $table->integer('amount')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->string('ini')->nullable();
            $table->string('pid')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
