<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->paginate(config('custom.paginate.category'));
        return view('web.categories.index')->with([
            'categories' => $categories,
        ]);
    }

    public function create(Request $request, $categoryId)
    {
        if (session('word')) {
            $request->session()->forget('word');
        }

        return redirect()->action('Web\LessonsController@create', [
            'categoryId' => $categoryId,
        ]);

    }
}
