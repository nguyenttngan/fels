<?php

use Illuminate\Database\Seeder;
use App\Models\Lesson;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lesson_word')->truncate();
        DB::table('follows')->truncate();
        Lesson::truncate();
        $this->call(CategoriesTableSeeder::class);
        $this->call(WordsTableSeeder::class);
        $this->call(MeaningsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
