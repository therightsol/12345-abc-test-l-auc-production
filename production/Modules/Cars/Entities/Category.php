<?php

namespace Modules\Cars\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CommonBackend\Entities\BaseModel;

class Category extends BaseModel
{
    protected $fillable = ['id', 'category', 'category_parent_id'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
