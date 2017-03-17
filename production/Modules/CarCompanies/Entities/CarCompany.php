<?php

namespace Modules\CarCompanies\Entities;

use Illuminate\Database\Eloquent\Model;

class CarCompany extends Model
{
    protected $fillable = ['company_name'];
    protected $table = 'car_companies';

/*    public function getForeignKey()
    {
        return 'car_company_id';
    }*/


    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
