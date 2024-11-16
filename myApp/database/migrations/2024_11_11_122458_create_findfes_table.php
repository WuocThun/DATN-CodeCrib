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
        Schema::create('findfes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tiêu đề
            $table->text('description')->nullable(); // Mô tả
            $table->decimal('price', 10, 2); // Giá cho thuê
            $table->integer('area'); // Diện tích
            $table->string('image_path')->nullable(); // Hình ảnh
            $table->string('image')->nullable(); // Hình ảnh
            $table->string('contact_name'); // Họ tên người liên hệ
            $table->string('contact_phone'); // Số điện thoại liên hệ
            $table->integer('gender_rental');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('findfes');
    }
};
