<?php

namespace App\Http\Controllers\Auction;


use App\QueryBuilder;

class Filters extends QueryBuilder
{
    /**
     * @param $order
     */
    public function order_by($order)
    {
        $this->builder->orderBy('bid_starting_amount', $order);
    }
    
    public function year($year)
    {
        $this->builder->whereHas('car', function($query)use($year){
            $query->where('manufacturing_year', 'like', $year);
        });
    }
    public function company($company)
    {
        $this->builder->whereHas('car.carModel.carCompany', function($query)use($company){
            $query->where('company_name', 'like', $company);
        });
    }
    public function model($model)
    {
        $this->builder->whereHas('car.carModel', function($query)use($model){
            $query->where('model_name', 'like', $model);
        });
    }
    public function body_type($body_type)
    {
        $this->builder->whereHas('car', function($query)use($body_type){
            $query->where('body_type', 'like', $body_type);
        });
    }
    public function kilometer($kilometers)
    {
        $this->builder->whereHas('car', function($query)use($kilometers){
            $query->where('kilometers', 'like', $kilometers);
        });
    }
    public function transmission($transmission)
    {
        $this->builder->whereHas('car', function($query)use($transmission){
            $query->where('transmission', 'like', $transmission);
        });
    }
    public function location($city_of_registration)
    {
        $this->builder->whereHas('car', function($query)use($city_of_registration){
            $query->where('city_of_registration', 'like', $city_of_registration);
        });
    }
    public function price($price)
    {
        $this->builder->where('bid_starting_amount', 'like', '%'.$price.'%');
    }
}