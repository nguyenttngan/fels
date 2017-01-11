<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreWord;
use App\Http\Requests\UpdateWord;
use App\Models\Category;
use App\Models\Meaning;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.words.index')->with([
            'words' => Word::paginate(config('custom.paginate.admin.word')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.words.create')->with([
            'categoriesCollection' => Category::all()->pluck('name', 'id'),
        ]);
    }

    /**
     * @param StoreWord $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreWord $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $word = Word::create([
                'word' => $data['word'],
                'category_id' => $data['category'],
                'meaning_id' => 0
            ]);

            foreach ($data['meaning'] as $key => $meaning) {
                $meaning = Meaning::create([
                    'word_id' => $word->id,
                    'content' => $meaning
                ]);
                if ($key == 0) {
                    $word->meaning_id = $meaning->id;
                    $word->save();
                }
            }
            DB::commit();

            return redirect()
                ->action('Admin\WordsController@index')
                ->with('status', trans('messages.success', [
                    'Action' => trans('messages.create'),
                    'item' => trans_choice('messages.words', 1),
                ]));
        } catch(\Exception $e) {
            DB::rollBack();

            return redirect()
                ->action('Admin\WordsController@index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.words.show')->with([
            'word' => Word::findOrFail($id)
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
        $word = Word::findOrFail($id);

        return view('admin.words.edit')->with([
            'word' => $word,
            'categoriesCollection' => Category::all()->pluck('name', 'id'),
            'falseMeanings' =>  $word->meanings->filter(function($meaning) use ($word) {
                return $word->meaning_id != $meaning->id;
            })
        ]);
    }

    /**
     * @param StoreWord $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateWord $request, $id)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            Word::where('id', $id)->update([
                'word' => $data['word-content'],
                'category_id' => $data['category'],
            ]);

            foreach ($data['meaning'] as $id => $meaning) {
                Meaning::where('id', $id)->update([
                    'content' => $meaning
                ]);
            }

            DB::commit();

            return redirect()
                ->action('Admin\WordsController@index')
                ->with('status', trans('messages.success', [
                    'Action' => trans('messages.update'),
                    'item' => trans_choice('messages.words', 1),
                ]));
        } catch(\Exception $e) {
            DB::rollBack();

            return redirect()
                ->action('Admin\WordsController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $word = Word::findOrFail($id);
        DB::beginTransaction();
        try {
            foreach($word->meanings as $meaning) {
                $meaning->delete();
            }
            if($word->lesson) {
                $word->lesson->detach();
            }
            $word->delete();
            DB::commit();

            return redirect()
                ->action('Admin\WordsController@index')
                ->with('status', trans('messages.success', [
                    'Action' => trans('messages.delete'),
                    'item' => trans_choice('messages.categories', 1),
                ]));
        } catch(\Exception $e) {
            DB::rollBack();

            return redirect()
                ->action('Admin\WordsController@index');
        }
    }
}
