<?php

namespace Modules\Cars\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CarMetas\Entities\CarMeta;
use Modules\CarModels\Entities\CarModel;
use Modules\EngineTypes\Entities\EngineType;
use Modules\Features\Entities\Feature;

class Car extends Model
{
    protected $fillable =
        ['title', 'average_price','minimum_price', 'manufacturing_year',
            'car_model_id', 'engine_type_id', 'trim','exterior_color', 'interior_color',
            'grade', 'kilometers', 'number_plate', 'engine_number',
            'chassis_number', 'city_of_registration', 'transmission',
            'body_type', 'drivetrain'];

    protected $table = 'cars';


    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function meta()
    {
        return $this->hasMany(CarMeta::class);
    }

    public function engineType()
    {
        return $this->belongsTo(EngineType::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'car_categories');
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class,'car_features');

    }

}
