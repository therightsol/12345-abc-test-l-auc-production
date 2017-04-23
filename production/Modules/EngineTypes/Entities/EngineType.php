<?php

namespace Modules\EngineTypes\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CommonBackend\Entities\BaseModel;

class EngineType extends BaseModel
{
    protected $fillable = ['title'];

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
