// paths
var combine_dir = 'resources/assets';
var build_dir = 'resources/assets/build';
var less_file = 'main';
var less_output = combine_dir + '/css';

// set scripts to combine
var scripts = [
    'vendor/jquery/jquery.js',
    'js/main.js'
];

// set styles to combine
// compiled less file should be last
var styles = [
    'vendor/normalize/normalize.css',
    'css/'+less_file+'.css'
];

// files to version (cache bust)
var version = [
    'css/all.css',
    'js/all.js'
];

// require elixir
var elixir = require('laravel-elixir');

// mix ingredients
elixir(function(mix) {
    mix.routes().events()
       .less(less_file+'.less', less_output)
       .styles(styles, combine_dir)
       .scripts(scripts, combine_dir)
       .version(version, build_dir);
});