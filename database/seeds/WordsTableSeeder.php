<?php

use Illuminate\Database\Seeder;
use App\Models\Word;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = \App\Models\Category::all();
        foreach ($categories as $category) {
            factory(Word::class, 6)->create([
                'category_id' => $category->id,
                'meaning_id' => 1,
            ]);
        }
    }
}
