<?php namespace app\Providers;

use HTML;
use Illuminate\Html\HtmlServiceProvider;
use Request;

// use Route;

class MacroServiceProvider extends HtmlServiceProvider
{
    /**
    * Register the application services.
    *
    * @return void
    */
    public function register()
    {
        // Macros must be loaded after the HTMLServiceProvider's
        // register method is called. Otherwise, csrf tokens
        // will not be generated
        parent::register();

        // Load macros
        require base_path() . '/app/Gluii/Helpers/HtmlMacros.php';
        require base_path() . '/app/Gluii/Helpers/FormMacros.php';
    }
}
