<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numOfLearnedWord = Word::query()->learned(Auth::id())->count();
        $numOfFollowed = Auth::user()->followers->count();
        $lessons = Lesson::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(config('custom.paginate.lesson'), ['*'], 'activities');
        $follows = User::findorFail(Auth::id())->follows()->get(['followed_id'])->all();
        $lessonsOfFollowed = Lesson::whereIn('user_id', array_column($follows, 'followed_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(config('custom.paginate.lesson'), ['*'], 'activitiesf');
        $users = User::where('role', '!=', config('custom.role.admin'))
            ->where('id', '!=', Auth::id())
            ->orderBy('created_at', 'asc')
            ->paginate(config('custom.paginate.user'), ['*'], 'members');

        return view('web.home', [
            'numOfLearnedWord' => $numOfLearnedWord,
            'numOfFollowed' => $numOfFollowed,
            'lessons' => $lessons,
            'lessonsOfFollowed' => $lessonsOfFollowed,
            'follows' => $follows,
            'users' => $users,
        ]);
    }
}
