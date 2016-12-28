<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Lesson;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = Category::all();
        foreach ($users as $user) {
            factory(Lesson::class, 5)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
