<?php
/**
 * Created by PhpStorm.
 * User: alishan
 * Date: 3/14/2017
 * Time: 10:03 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryBuilder
{

    protected $request;

    protected $builder;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {

            // if($value) ? $this->$name($value) : $this->name;

            if(!$value) continue;
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->all();
    }
}