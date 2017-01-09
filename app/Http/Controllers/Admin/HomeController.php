<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Word;
use App\Models\Category;
use App\Models\Lesson;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home')->with([
            'user' => User::count(),
            'categories' => Category::count(),
            'words' => Word::count(),
            'lessons' => Lesson::count(),
        ]);
    }
}
