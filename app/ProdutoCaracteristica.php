<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoCaracteristica extends Model
{
    use SoftDeletes;

    protected $table = "produto_caracteristica";
    protected $primaryKey = "pca_id";
    protected $dates = ['deleted_at'];

    public function getPcaValorAttribute($value)
    {
        return number_format($value, 2, '.', '');
    }

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'pca_pro_id', 'pro_id');

    }

    public function molde()
    {
        return $this->hasOne('App\Molde', 'mol_id', 'pca_mol_id');
    }

    public function tecido()
    {
        return $this->hasOne('App\Tecido', 'tec_id', 'pca_tec_id');
    }

    public function cor()
    {
        return $this->hasOne('App\Cor', 'cor_id', 'pca_cor_id');
    }

    public function estoque()
    {
        return $this->hasOne('App\EstoqueProduto', 'epr_pca_id', 'pca_id');

    }


}
