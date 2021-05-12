<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoProdutoModelo extends Model
{
    use SoftDeletes;

    protected $table = "tipo_produto_modelo";
    protected $primaryKey = "tpm_id";

}
