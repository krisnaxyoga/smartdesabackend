<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class VillageScope implements Scope
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
            $user = Auth::user();
            $builder->where($model->getTable().".desa_id", $user->desa_id);
        }
        if(request('desa_id') != null) {
            $builder->where($model->getTable().".desa_id",request('desa_id'));
        }

    }

}
