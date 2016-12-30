<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Word;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LessonsController extends Controller
{
    public function create($categoryId, $lessonId = null)
    {
        $userId = Auth::id();
        $category = Category::find($categoryId);
        if (!$lessonId) {
            $lesson = Lesson::create([
                'user_id' => $userId,
                'category_id' => $categoryId,
            ]);
            $lessonId = $lesson->id;
        } else {
            $lesson = Lesson::find($lessonId);
        }

        $query = Word::where('words.category_id', $categoryId);
        $word = $query->unlearned($userId)->inRandomOrder()->first();
        if (!$word) {
             $word = $query->inRandomOrder()->first();
        }

        return view('web.lessons.create')->with([
            'category' => $category,
            'word' => $word,
            'lesson' => $lesson,
        ]);
    }
}
