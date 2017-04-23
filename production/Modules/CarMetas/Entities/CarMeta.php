<?php

namespace Modules\CarMetas\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CommonBackend\Entities\BaseModel;

class CarMeta extends BaseModel
{
    protected $fillable = ['meta_key', 'meta_value'];
    protected $casts = ['meta_value' => 'array'];
}
