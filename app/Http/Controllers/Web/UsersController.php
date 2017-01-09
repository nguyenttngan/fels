<?php
namespace App\Http\Controllers\Web;

/**
 * Created by PhpStorm.
 * User: Vita Dolce
 * Date: 28/12/2016
 * Time: 3:16 CH
 */
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        if (!$user->exists) {
            $user = Auth::user();
        } else {
            $following = Auth::user()->isFollowing($user);
        }

        return view('web.users.show', compact('user', 'following'));
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('web.users.edit', ['user' => Auth::user()]);
    }

    /**
     * @param UpdateUserProfile $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(UpdateUserProfile $request)
    {
        $user = Auth::user();
        $user->fill($request->except('password', 'avatar'));
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $user->id . '_' . time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(config('custom.url.avatar'), $filename);
            if ($user->avatar != config('custom.image.default')) {
                unlink(public_path(config('custom.url.avatar')) . $user->avatar);
            }

            $user->avatar = $filename;
        }

        if ($request->get('password') != "") {
            $user->password = $request->get('password');
        }

        $user->save();

        return view('web.users.show', compact('user'));
    }
}
