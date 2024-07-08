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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_category_id')->default(0);
            $table->string('category_name');
            $table->tinyInteger('pendingProcess')->default(1);

            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(0)->index();
            $table->string('banner')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('categories');
    }
};
