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
    public function index()
    {
        $lessons = Lesson::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(config('custom.paginate.lesson'));
        abort_if(!$lessons, 404, trans('messages.noact'));

        return view('web.lessons.index')->with([
            'lessons' => $lessons,
        ]);
    }

    public function show($lessonId)
    {
        $lesson = Lesson::find($lessonId);
        abort_if(!$lesson, 404, trans('messages.exist', [
            'item' => trans_choice('messages.lessons', 1)
        ]));

        $answers = $lesson->meanings->pluck('content', 'word_id');

        return view('web.lessons.show')->with([
            'lesson' => $lesson,
            'answers' => $answers,
            'numAns' => $lesson->words->count(),
            'numCorrectAns' => $lesson->words->filter(function($word) {
                return $word->meaning_id == $word->pivot->meaning_id;
            })->count(),
        ]);
    }

    public function create(Request $request, $categoryId, $lessonId = null, $count = 0)
    {
        $userId = Auth::id();
        $category = Category::find($categoryId);
        if ($category->words()->count() < config('custom.wordsPerLesson')) {
            abort(404, trans('messages.notenoughword'));
        }

        if ($request->session()->has('word')) {
            $word = session('word');
        } else {
            $word = Word::where('words.category_id', $categoryId)
                ->unlearned($userId)
                ->inRandomOrder()
                ->first(['words.*']);
            if (!$word) {
                $word = Word::where('words.category_id', $categoryId)
                    ->relearned($userId)
                    ->inRandomOrder()
                    ->first(['words.*']);
            }

            session(['word' => $word]);
        }

        abort_if(!$word, 404, trans('messages.empty', [
            'item' => trans_choice('messages.words', 1)
        ]));

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
        DB::beginTransaction();
        try {
            if (!$lessonId) {
                $lesson = Lesson::create([
                    'user_id' => $userId,
                    'category_id' => $categoryId,
                ]);
                $lessonId = $lesson->id;
            }

            Lesson::find($lessonId)->words()->attach($wordId, ['meaning_id' => $selectedMeaning]);
            DB::commit();
            if ($count < config('custom.wordsPerLesson')) {
                return redirect()->action('Web\LessonsController@create', [
                    'categoryId' => $categoryId,
                    'lessonId' => $lessonId,
                    'count' => $count,
                ]);
            }

            return redirect()->action('Web\LessonsController@show', ['lessonId' => $lessonId]);
        } catch(\Exception $e) {
            DB::rollBack();
        }
    }
}
