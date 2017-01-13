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
        $j = 1;
        foreach ($categories as $category) {
            for ($i = 0; $i < 10; $i++) {
                factory(Word::class, 1)->create([
                    'category_id' => $category->id,
                    'meaning_id' => rand($j, $j+3),
                ]);
                $j += 4;
            }
        }
    }
}
