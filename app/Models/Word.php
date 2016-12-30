<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'word',
        'meaning_id',
        'category_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meanings()
    {
        return $this->hasMany(Meaning::class);
    }

    /**
     * @param $query
     */
    public function scopeLearned($query, $userId)
    {
        return $query->join('lesson_word', 'words.id', '=', 'lesson_word.word_id')
            ->join('lessons', 'lessons.id', '=', 'lesson_word.lesson_id')
            ->where('lessons.user_id', '=', $userId);
    }

    /**
     * @param $query
     */
    public function scopeUnlearned($query, $userId)
    {
        return $query->leftJoin('lesson_word', 'words.id', '=', 'lesson_word.word_id')
            ->leftJoin('lessons', 'lessons.id', '=', 'lesson_word.lesson_id')
            ->where(function ($query) use ($userId) {
                $query->whereNull('lessons.user_id')
                    ->orWhere('lessons.user_id', '!=', $userId);
            });
    }
}
