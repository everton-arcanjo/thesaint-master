<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    protected $table = "pedido";
    protected $primaryKey = "ped_id";
    protected $dates = ['deleted_at'];

    public function produto()
    {
       return $this->hasMany('App\PedidoProduto', 'ppr_id', 'ped_id');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'ped_cli_id', 'cli_id');
    }

    public function pedidoproduto()
    {

        return $this->hasMany('App\PedidoProduto', 'ppr_ped_id', 'ped_id');

    }

    public function vendedor()
    {

        return $this->hasMany('App\Usuario', 'ped_usu_id', 'usu_id');

    }
}
