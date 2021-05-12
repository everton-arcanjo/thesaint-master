<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoProduto extends Model
{
    use SoftDeletes;

    protected $table = "pedido_produto";
    protected $primaryKey = "ppr_id";
    protected $dates = ['deleted_at'];

    public function pedido()
    {
        return $this->belongsTo('App\Pedido', 'ppr_ped_id', 'ped_id');
    }

    public function molde()
    {
        return $this->hasOne('App\Molde', 'mol_id', 'ppr_mol_id');
    }

    public function produtocaracteristica()
    {
        return $this->hasOne('App\ProdutoCaracteristica', 'pca_id', 'ppr_pca_id');
    }


}
