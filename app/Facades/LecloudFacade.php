<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class LecloudFacade extends Facade {

    public static function getFacadeAccessor()
    {
        return 'LecloudService';
    }

}