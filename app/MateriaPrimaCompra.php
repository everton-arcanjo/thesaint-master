<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriaPrimaCompra extends Model
{
    use SoftDeletes;

    protected $table = "materia_prima_compra";
    protected $primaryKey = "mtc_id";

    protected $dates = ['deleted_at'];

    public function cor()
    {
        return $this->hasOne('App\Cor','cor_id','mtc_cor_id');

    }

    public function tecido()
    {
        return $this->hasOne('App\Tecido','tec_id','mtc_tec_id');

    }

    public function fornecedor()
    {
        return $this->hasOne('App\Fornecedor','for_id','mtc_for_id');
    }

    public function item()
    {
        return $this->hasMany('App\MateriaPrimaItem', 'mpi_mtc_id', 'mtc_id');
    }


}
