<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\QueryFilter;
class BatDongSan extends Model
{
    //
    protected $table="bat_dong_san";
    protected $primaryKey="idBDS";
    public $timestamps = FALSE;

    public function scopeFilter($query, QueryFilter $filters)
    {
    	return $filters->apply($query);
    }
}
