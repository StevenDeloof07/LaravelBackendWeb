<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create(['name' => "pc"]);
        Category::create(['name' => "console"]);
        Category::create(['name' => "AI"]);

        Question::factory(20)->create();
    }
}
