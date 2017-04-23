<?php

/**
 * Created by PhpStorm.
 * User: SAA
 * Date: 4/14/2017
 * Time: 10:40 PM
 */
namespace Modules\CommonBackend\Entities;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::deleting(function(){
            if(!\Auth::user()->hasRole(['admin'])){
                return false;
            }
        });
    }
}