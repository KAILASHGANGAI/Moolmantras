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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->string('variant_name')->nullable();
            $table->tinyInteger('pendingProcess')->default(1);
            $table->string('status')->default(1)->comment('0 = inactive, 1 = active');
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->string('stock_in_hand')->default(0);
            $table->string('weight')->nullable()->comment('weight in Kg');
            $table->string('weightUnit')->default('kilogram');
            $table->string('compare_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->date('PushedDate')->nullable();
            $table->date('retriveDate')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
