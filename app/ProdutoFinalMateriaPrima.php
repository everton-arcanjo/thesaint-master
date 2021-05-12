<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoFinalMateriaPrima extends Model
{
    use SoftDeletes;

    protected $table = "produtofinal_materiaprima";
    protected $primaryKey = "pmp_id";
    protected $dates = ['deleted_at'];
}
