<?php 

namespace App\Traits;

/**
 * Helper for collecting merchant data from logged user
 */


use App\Scopes\MerchantScope;
use Auth;

trait Merchant
{
    
    public static function bootMerchant()
    {
        static::addGlobalScope(new MerchantScope);
    }


}
