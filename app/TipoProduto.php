<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoProduto extends Model
{
    use SoftDeletes;

    protected $table = "tipo_produto";
    protected $primaryKey = "tpr_id";
    protected $dates = ['deleted_at'];

    public function modelo()
    {
        return $this->hasMany('App\TipoProdutoModelo', 'tpm_tpr_id', 'tpr_id');

    }

}
