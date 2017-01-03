<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Word;
use App\Models\Meaning;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LessonsController extends Controller
{
    public function create(Request $request, $categoryId, $lessonId = null, $count = 0)
    {
        $userId = Auth::id();
        $category = Category::find($categoryId);
        if ($request->session()->has('word')) {
            $word = session('word');
        } else {
            $word = Word::where('words.category_id', $categoryId)
                ->unlearned($userId)
                ->inRandomOrder()
                ->first(['words.*']);
            if (!$word) {
                $word = Word::where('words.category_id', $categoryId)
                    ->relearned($lessonId)
                    ->inRandomOrder()
                    ->first(['words.*']);
            }
            session(['word' => $word]);
        }

        return view('web.lessons.create')->with([
            'category' => $category,
            'word' => $word,
            'lessonId' => $lessonId,
            'correctMng' => Meaning::find($word->meaning_id),
            'count' => ++$count,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $request->session()->forget('word');
        $userId = Auth::id();
        $categoryId = $data['cateId'];
        $wordId = $data['wordId'];
        $lessonId = $data['lessonId'];
        $selectedMeaning = $data['selectedMng'];
        $count = $data['count'];
        $category = Category::find($categoryId);
        DB::beginTransaction();
        try {
            if (!$lessonId) {
                $lesson = Lesson::create([
                    'user_id' => $userId,
                    'category_id' => $categoryId,
                ]);
                $lessonId = $lesson->id;
            }

            if ($hasNextLesson = $count < config('custom.wordsPerLesson')) {
                Lesson::find($lessonId)->words()->attach($wordId, ['meaning_id' => $selectedMeaning]);
            }

            DB::commit();
            if ($hasNextLesson) {
                return redirect()->action('Web\LessonsController@create', [
                    'categoryId' => $categoryId,
                    'lessonId' => $lessonId,
                    'count' => $count,
                ]);
            }

            // TODO
            return "Result";
        } catch(\Exception $e) {
            DB::rollBack();
        }
    }
}
