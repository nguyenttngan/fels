<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Word;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'followed_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'user_id')->withTimestamps();
    }

    public function countLearnedWords($categoryId)
    {
        $learnedWordsNum = Word::where('words.category_id', $categoryId)->learned(Auth::id())->count();
        $totalWordsNum = Word::where('words.category_id', $categoryId)->count();
        return ($learnedWordsNum > $totalWordsNum)
            ? $totalWordsNum
            : $learnedWordsNum;
    }

    /**
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        $avatar = $this->avatar;
        if ($this->isLocalAvatar() || $this->isDefaultAvatar()) {
            return url(config('custom.url.avatar') . $avatar);
        }

        return $avatar;
    }

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @param $id
     * @return bool
     */
    public function isFollowing($user)
    {
        $follows = $this->follows;

        return $follows->contains($user);
    }

    public function isAdmin()
    {
        return $this->role == config('custom.role.admin');
    }

    /**
     * @param $request
     * @return string
     */
    public function updateAvatar($avatar)
    {
        $filename = $this->id . '_' . config('app.name') . time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(config('custom.url.avatar'), $filename);
        if ($this->isLocalAvatar()) {
            unlink(public_path(config('custom.url.avatar')) . $this->avatar);
        }

        return $this->avatar = $filename;
    }

    public function isDefaultAvatar()
    {
        return $this->avatar == config('custom.image.default');
    }

    public function isLocalAvatar()
    {
        return strpos($this->avatar, config('app.name')) !== false;
    }
}
