<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriaPrima extends Model
{
    use SoftDeletes;

    protected $table = "materia_prima";
    protected $primaryKey = "mpr_id";
    protected $dates = ['deleted_at'];

    public function materiaprimacompra()
    {
        return $this->belongsTo('App\MateriaPrimaCompra','mtc_mpr_id','mpr_id');
    }

    public function cor()
    {
        return $this->hasOne('App\Cor', 'cor_id', 'mpr_cor_id');
    }

    public function tecido()
    {
        return $this->hasOne('App\Tecido', 'tec_id', 'mpr_tec_id');
    }

}
