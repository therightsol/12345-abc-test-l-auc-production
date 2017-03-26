<?php

namespace Modules\CarMetas\Entities;

use Illuminate\Database\Eloquent\Model;

class CarMeta extends Model
{
    protected $fillable = ['meta_key', 'meta_value'];
    protected $casts = ['meta_value' => 'array'];
}
