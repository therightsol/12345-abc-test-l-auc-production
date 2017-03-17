<?php

namespace Modules\EngineTypes\Entities;

use Illuminate\Database\Eloquent\Model;

class EngineType extends Model
{
    protected $fillable = ['title'];

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
