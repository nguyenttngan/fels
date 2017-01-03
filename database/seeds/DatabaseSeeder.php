<?php

use Illuminate\Database\Seeder;

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
        DB::table('lessons')->truncate();
        $this->call(CategoriesTableSeeder::class);
        $this->call(WordsTableSeeder::class);
        $this->call(MeaningsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
