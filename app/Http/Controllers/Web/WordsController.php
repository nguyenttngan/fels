<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Word;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

/**
 * Created by PhpStorm.
 * User: Vita Dolce
 * Date: 24/12/2016
 * Time: 4:55 CH
 */
class WordsController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filter = $request->filter;
        $categoryId = $request->category_id;
        $userId = Auth::id();
        $categorySelect = Category::all()->pluck('name', 'id');

        $query = Word::query();

        if ($categoryId) {
            $query->where('words.category_id', $categoryId);
        }
        if ($filter == config("custom.filter.learned")) {
            $query->learned($userId);
        } elseif ($filter == config("custom.filter.unlearned")) {
            $query->unlearned($userId);
        }
        $getWords = $query->get(['words.*']);
        $page = Paginator::resolveCurrentPage()?:config('custom.paginate.page');
        $perPage = config('custom.paginate.word');
        $words = new Paginator($getWords->forPage($page, $perPage), $getWords->count(), $perPage, $page, [
            'path' => $request->fullUrl(),
        ]);

        return view('web.words.index', compact('filter', 'categoryId', 'words', 'categorySelect'));
    }
}


