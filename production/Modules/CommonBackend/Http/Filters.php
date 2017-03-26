<?php

namespace Modules\CommonBackend\Http;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\CarModels\Entities\CarModel;

class Filters
{

    protected $request;

    protected $builder;
    protected $modelPath = '\\App\\';


    protected $model;
    public $belongsToThrough = [];
    public $belongsTo = [];
    protected $tableNames = [];
    public $column = [];
    protected $select = [];

    /**
     * QueryFilter constructor.
     * @param $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        $this->init();
        foreach ($this->filters() as $name => $value) {

            // if($value) ? $this->$name($value) : $this->name;

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

    protected function init()
    {
        $this->model = $this->builder->getModel();
        $this->join();
        $this->defaultOrder();

    }


    protected function join()
    {


        $this->tableNames[$this->model->getTable()] = $this->column;

        $prevModel = $this->model;

        foreach ($this->belongsTo as $model => $value) {

            $instance = new $model;
            $this->builder->leftJoin(
                $instance->getTable(),  //regions
                $this->model->getTable() . '.' . $instance->getForeignKey(), //cities.region_id
                '=',
                $instance->getQualifiedKeyName() //regions.id
            );
            $this->tableNames[$instance->getTable()] = $value;
        }

        foreach ($this->belongsToThrough as $model => $value) {
            $instance = new $model;
            $this->builder->join(
                $instance->getTable(),  //regions
                $prevModel->getTable() . '.' . $instance->getForeignKey(), //cities.region_id
                '=',
                $instance->getQualifiedKeyName() //regions.id
            );


            $prevModel = $instance;
            $this->tableNames[$instance->getTable()] = $value;
        }



        $this->selecting();

    }


    protected function selecting()
    {
        foreach ($this->tableNames as $table => $columns) {

            foreach ($columns as $column) {
                $this->select[] = "{$table}.{$column}";
            }
        }


        $this->builder->select($this->select);

    }

    public function search($input = false)
    {
        if (empty($input)) {
            return;
        }
        foreach ($this->tableNames as $table => $columns) {

            foreach ($columns as $column) {
                $this->builder->orWhere($table . '.' . $column, 'like', $input . '%');
                $this->builder->orWhere($table . '.' . $column, 'like', '% '.$input . '%');
            }
        }
    }

    protected function defaultOrder()
    {

        if (!$this->request->has('order') and !$this->request->has('table')) $this->builder->orderBy($this->model->getKeyName(), 'desc'); return;
    }

    protected function order()
    {
        if (!$this->request->has('order') and !$this->request->has('table')) return;
        $modelAndColumn = $this->request->input('table');
        $orderBy = $this->request->input('order');

        $explode = explode('.', $modelAndColumn);
        if (sizeof($explode) > 2 or sizeof($explode) < 2) return;

        $collections = $this->belongsToThrough + [get_class($this->model) =>$this->column] + $this->belongsTo;



        $table = ucfirst($explode[0]);
        $column = $explode[1];

        $isFound = false;
        foreach ($collections as $collection => $value) {

            if(trim( substr($collection, strrpos($collection, '\\' )), '\\' ) == $table ){
                $isFound = true;
                $table = $collection;
                break;
            }
        }

        if(!$isFound) return;



        if (!in_array($column, $collections[$table])) return;

        $instance = new $table;

        $this->builder->orderBy($instance->getTable() . '.' . $column, $orderBy);
    }

}