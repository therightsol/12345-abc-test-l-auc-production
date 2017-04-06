<?php

namespace Modules\Auctions\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Cars\Entities\Car;

class Auction extends Model
{
    protected $fillable = ['bid_starting_amount','car_id', 'average_bit', 'start_date', 'end_date','start_time', 'end_time','winner_user_id'];


    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    protected $dates = [
        'start_date',
        'end_date'
    ];

}
