<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Word;
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
        $numOfFollowed = Auth::user()->follows()->count();

        return view('web.home', compact('numOfLearnedWord', 'numOfFollowed'));
    }
}
