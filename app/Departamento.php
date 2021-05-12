<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use SoftDeletes;

    protected $table = "departamento";
    protected $primaryKey = "dep_id";

    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'usu_id', 'other_key');
    }

}
