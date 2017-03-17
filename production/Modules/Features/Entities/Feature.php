<?php

namespace Modules\Features\Entities;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['title','icon_path'];
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
