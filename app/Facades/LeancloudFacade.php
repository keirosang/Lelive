<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class LeancloudFacade extends Facade {

    public static function getFacadeAccessor()
    {
        return 'LeancloudService';
    }

}