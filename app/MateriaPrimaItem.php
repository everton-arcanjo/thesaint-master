<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriaPrimaItem extends Model
{
    use SoftDeletes;

    protected $table = 'materia_prima_item';
    protected $primaryKey = 'mpi_id';
    protected $dates = ['deleted_at'];

    public function tecido()
    {
        return $this->hasOne('App\Tecido', 'tec_id', 'mpi_tec_id');
    }

}
