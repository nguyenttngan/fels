<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index')->with([
            'categories' => Category::paginate(config('custom.paginate.admin.category')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $data = $request->all();
        Category::create([
            'name' => $data['name'],
        ]);

        return redirect()
            ->action('Admin\CategoryController@index')
            ->with('status', trans('messages.success', [
                'Action' => trans('messages.create'),
                'item' => trans_choice('messages.categories', 1),
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findorFail($id);
        $words = $category->words()->paginate(config('custom.paginate.admin.word'));

        return view('admin.categories.show')->with([
            'category' => $category,
            'words' => $words,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.categories.edit')->with([
            'category' => Category::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, $id)
    {
        $data = $request->all();
        Category::where('id', $id)->update([
            'name' => $data['name']
        ]);

        return redirect()
            ->action('Admin\CategoryController@index')
            ->with('status', trans('messages.success', [
                'Action' => trans('messages.update'),
                'item' => trans_choice('messages.categories', 1),
            ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorFail($id);
        DB::beginTransaction();
        try {
            foreach ($category->lessons as $lesson) {
                $lesson->words()->detach();
            }
            $category->lessons()->delete();
            $category->meanings()->delete();
            $category->words()->delete();
            $category->delete();
            DB::commit();

            return redirect()
                ->action('Admin\CategoryController@index')
                ->with('status', trans('messages.success', [
                    'Action' => trans('messages.delete'),
                    'item' => trans_choice('messages.categories', 1),
                ]));
        } catch(\Exception $e) {
            DB::rollBack();

            return redirect()
                ->action('Admin\CategoryController@index');
        }
    }
}
