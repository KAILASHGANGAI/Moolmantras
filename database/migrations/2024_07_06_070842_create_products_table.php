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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('product_name');
            $table->unsignedBigInteger('category_id');
            $table->boolean('pendingProcess')->default(0);
            $table->boolean('status')->default(0);
            $table->string('sku')->unique();
            $table->string('barcode')->nullable();
            $table->integer('stock_on_hand')->default(0);
            $table->decimal('compare_price', 8, 2);
            $table->decimal('selling_price', 8, 2);
            $table->string('image');
            $table->text('description');
            $table->decimal('weight', 8, 2)->default(0);
            $table->string('weightUnit')->nullable();
            $table->date('PushedDate');
            $table->date('retriveDate');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
