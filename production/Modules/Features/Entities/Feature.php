<?php

namespace Modules\Features\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CommonBackend\Entities\BaseModel;

class Feature extends BaseModel
{
    protected $fillable = ['title','icon_path'];
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
