<?php
/**
 * Created by PhpStorm.
 * User: Vita Dolce
 * Date: 27/12/2016
 * Time: 7:56 CH
 */
return [
    'filter' => [
        'learned' => 'learned',
        'unlearned' => 'unlearned',
    ],
    'paginate' => [
        'category' => 4,
        'lesson' => 5,
        'user' => 5,
        'word' => 10,
        'page' => 1,
        'admin' => [
            'word' => 5,
            'category' => 10,
            'user' => 10,
        ],
    ],
    'wordsPerLesson' => 5,
    'url' => [
        'avatar' => 'uploads/avatars/',
    ],
    'image' => [
        'default' => 'default.jpg',
    ],
    'role' => [
        'admin' => 'admin',
        'user' => 'user',
    ],
    'adminbrand' => 'FELS Administrator',
    'provider' => [
        'facebook' => 'facebook',
        'google' => 'google',
        'twitter' => 'twitter',
    ],
];
