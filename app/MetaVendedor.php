<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaVendedor extends Model
{
    use SoftDeletes;

    protected $table = "meta_vendedor";
    protected $primaryKey = "mve_id";
    protected $dates = ['deleted_at'];

    public function vendedor()
    {
        return $this->hasOne('App\Usuario', 'usu_id', 'mve_usu_id');
    }
}
