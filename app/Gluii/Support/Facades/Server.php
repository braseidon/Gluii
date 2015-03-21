<?php namespace App\Gluii\Support\Facades;

use Illuminate\Support\Facades\Facade;
use League\Glider\ServerFactory;

class Server extends Facade
{

    /**
    * Get the registered name of the component.
    *
    * @return string
    */
    protected static function getFacadeAccessor()
    {
        return 'Server';
    }
}
