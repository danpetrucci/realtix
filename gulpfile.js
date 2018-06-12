const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss');
});

elixir(function(mix) {
    mix.webpack('app.js'); // resources/assets/js/app.js
    mix.webpack('inmobiliaria_vue.js'); //My vue para inmobiliarias
    mix.webpack('inmueble_vue.js'); //My vue para inmuebles

});

/*Custom code*/

elixir(function(mix) {
    mix.sass('custom_app.scss');
    mix.sass('login.scss'); 
});
