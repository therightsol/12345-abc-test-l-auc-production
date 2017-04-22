<?php

namespace Modules\GeneralSettings\Entities;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = ['key', 'value'];


    public function scopeCurrencySymbol($query)
    {
        return $query->where('key', 'currency_symbol')->pluck('value');
    }
}


