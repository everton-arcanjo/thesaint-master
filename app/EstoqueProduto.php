<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstoqueProduto extends Model
{
    use SoftDeletes;

    protected $table = "estoque_produto";
    protected $primaryKey = "epr_id";

    protected $dates = ['deleted_at'];

    public function produtocaracteristica()
    {
        return $this->hasOne('App\ProdutoCaracteristica','epr_pca_id','epr_pca_id');
    }

}
