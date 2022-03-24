<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
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
            if($value!='' && $value!=0){
                if (method_exists($this, $name)) {
                    call_user_func_array([$this, $name], array_filter([$value]));
                }
            }
            
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->all();
    }
}