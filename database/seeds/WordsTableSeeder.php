<?php

use Illuminate\Database\Seeder;
use App\Models\Word;
use App\Models\Category;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Word::truncate();
        $categories = Category::all();
        foreach ($categories as $category) {
            factory(Word::class, 50)->create([
                'category_id' => $category->id,
                'meaning_id' => 1,
            ]);
        }
    }
}
