<?php

namespace App\Traits;

/**
 * Helper for collecting merchant data from logged user
 */


use App\Scopes\VillageScope;
use Auth;

trait Village
{

    public static function bootVillage()
    {
        static::addGlobalScope(new VillageScope);
    }


}
