<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '=', config('custom.role.user'));
        return view('admin.users.index')->with([
            'users' => $users->paginate(config('custom.paginate.admin.user'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $data = $request->all();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'avatar' => config('custom.image.default'),
        ]);

        return redirect()
            ->action('Admin\UsersController@index')
            ->with('status', trans('messages.success', [
                'Action' => trans('messages.create'),
                'item' => trans_choice('messages.users', 1),
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
        return view('admin.users.show')->with([
            'user' => User::findOrFail($id)
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
        return view('admin.users.edit')->with([
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfile $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->except('password', 'avatar'));
        if ($request->hasFile('avatar')) {
            $user->updateAvatar($request->file('avatar'));
        }

        if ($request->get('password') != "") {
            $user->password = $request->get('password');
        }

        $user->save();

        return view('admin.users.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        DB::beginTransaction();
        try {
            foreach ($user->lessons as $lesson) {
                $lesson->words()->detach();
            }

            foreach ($user->follows as $follow) {
                $follow->detach();
            }
            $user->lessons()->delete();
            $user->follows()->delete();
            $user->delete();
            DB::commit();

            return redirect()
                ->action('Admin\UsersController@index')
                ->with('status', trans('messages.success', [
                    'Action' => trans('messages.delete'),
                    'item' => trans_choice('messages.users', 1),
                ]));
        } catch(\Exception $e) {
            DB::rollBack();

            return redirect()
                ->action('Admin\UsersController@index');
        }
    }
}
