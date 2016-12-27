<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Word;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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
        return config('custom.url.avatar') . $this->avatar;
    }
}
