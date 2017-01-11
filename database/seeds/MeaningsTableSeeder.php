<?php

use Illuminate\Database\Seeder;
use App\Models\Word;
use App\Models\Meaning;

class MeaningsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meaning::truncate();
        $words = Word::all();
        $i = 1;
        foreach ($words as $word) {
            factory(Meaning::class, 4)->create([
                'word_id' => $word->id,
            ]);
            $word->meaning_id = $i;
            $i += 4;
        }
    }
}
