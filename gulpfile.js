const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass([
        'app.scss',
        './bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css'
        ])
       .webpack('app.js')
       .scripts('form-delete.js')
       .scripts('lesson.js')
       .scripts('follow.js')
       .sass('./node_modules/bootstrap-material-design/dist/sassc/bootstrap-material-design.css')
       .scripts('./node_modules/bootstrap-material-design/dist/js/material.js')
       .sass('bootstrap-social.css');
});
