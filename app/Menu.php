<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table= "menu";
    protected $primaryKey = "mnu_id";
    protected $dates = ['deleted_at'];

    public function departamento()
    {
        return $this->belongsToMany('App\Departamento','menu_departamento','mdp_mnu_id','mdp_dep_id');
    }

}
