<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteEndereco extends Model
{
    use SoftDeletes;

    protected $table = "cliente_endereco";
    protected $primaryKey = "cen_id";
    protected $dates = ['deleted_at'];
}
