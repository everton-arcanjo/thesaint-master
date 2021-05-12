<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteContato extends Model
{
    use SoftDeletes;

    protected $table = "cliente_contato";
    protected $primaryKey = "cco_id";
    protected $dates = ['deleted_at'];
}
