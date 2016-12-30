<?php
namespace App\Http\Controllers\Web;

/**
 * Created by PhpStorm.
 * User: Vita Dolce
 * Date: 28/12/2016
 * Time: 3:16 CH
 */
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        if (!$user->exists) {
            $user = Auth::user();
        }

        return view('web.users.show', compact('user'));
    }
}
