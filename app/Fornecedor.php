<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes;

    protected $table = "fornecedor";
    protected $primaryKey = "for_id";
    protected $dates = ['deleted_at'];

    public function endereco()
    {
        return $this->hasOne('App\FornecedorEndereco', 'fen_for_id', 'for_id');

    }

}
