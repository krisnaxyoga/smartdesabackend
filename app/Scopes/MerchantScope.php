<?php 
namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class MerchantScope implements Scope
{
    
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if(Auth::check()){
            if(Auth::user()->user_type == "MERCHANT_USER") {
                $user = Auth::user();
                $builder->where($model->getTable().".merchant_id", $user->merchant_id);
                
            }
        }

    }

}
