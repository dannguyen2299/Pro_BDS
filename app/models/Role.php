<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table="role";
    protected $primaryKey="idRole";
    public $timestamps = FALSE;
    protected $fillable = [
        'TenQuyen', 'MoTa',
    ];
    public function user(){
        return $this->belongsToMany('App\User');
    }
}
