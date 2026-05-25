<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Спочатку створюємо користувачів (авторів)
        $this->call(UsersTableSeeder::class);

        // 2. Потім створюємо категорії
        $this->call(BlogCategoriesTableSeeder::class);

        // 3. І наприкінці генеруємо 100 статей за допомогою фабрики
        \App\Models\BlogPost::factory(100)->create();
    }
}
