<?php

namespace Modules\InspectionRequests\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Cars\Entities\Car;
use Modules\CommonBackend\Entities\BaseModel;
use Modules\Users\Entities\UserModel;

class InspectionRequest extends BaseModel
{
    protected $fillable = ['car_id','user_id','date_of_inspection','time_of_inspection'];
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    protected $dates = [
        'date_of_inspection'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }

}
