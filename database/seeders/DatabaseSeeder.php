<?php

namespace Database\Seeders;


use App\Models\Category;
use App\Models\FAQ;
use App\Models\Question;
use App\Models\User;
use App\Models\News;
use Database\Factories\FAQFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create();
        News::factory(2)->create();

        Category::create(['name' => "pc"]);
        Category::create(['name' => "console"]);
        Category::create(['name' => "AI"]);

        Question::factory(5)->create();

        #call other seeders
        $this->call([AdminSeeder::class]);
    }
}
