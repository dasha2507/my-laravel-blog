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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned(); // ID категорії
            $table->bigInteger('user_id')->unsigned();  // ID автора
            $table->string('slug')->unique(); // URL статті
            $table->string('title'); // Заголовок
            $table->text('excerpt')->nullable(); // Короткий анонс
            $table->text('content_raw'); // Текст без форматування
            $table->text('content_html'); // Текст з HTML тегами
            $table->boolean('is_published')->default(false); // Статус публікації
            $table->timestamp('published_at')->nullable(); // Дата публікації
            $table->timestamps();
            $table->softDeletes(); // М'яке видалення

            // Зв'язки між таблицями (Зовнішні ключі)
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('blog_categories');

            // Індекс для швидкого пошуку опублікованих статей
            $table->index('is_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
