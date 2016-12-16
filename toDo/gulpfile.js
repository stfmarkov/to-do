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


var paths = {
    'bootstrap': './bower_components/bootstrap/**',
    'font_awesome': './bower_components/font-awesome/**',
    'datetimepicker_css': './bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
    'datetimepicker_js': './bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    'momentjs': './bower_components/moment/moment.js',
    'jquery': './bower_components/jquery/dist/jquery.min.js',
    'vue': './bower_components/vue/dist/vue.js',
};

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js')

        .copy(paths.bootstrap, 'public/assets/bootstrap')
        .copy(paths.font_awesome, 'public/assets/css/font-awesome/')
        .copy(paths.datetimepicker_css, 'public/assets/css')
        .copy(paths.datetimepicker_js, 'public/assets/js')
        .copy(paths.momentjs, 'public/assets/js')
        .copy(paths.jquery, 'public/assets/js')
        .copy(paths.vue, 'public/assets/js')
});
