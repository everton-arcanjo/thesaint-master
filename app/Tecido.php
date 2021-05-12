<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tecido extends Model
{
    use SoftDeletes;

    protected $table = "tecido";
    protected $primaryKey = "tec_id";
    protected $dates = ['deleted_at'];
}
