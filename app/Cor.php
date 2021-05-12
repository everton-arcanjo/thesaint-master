<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cor extends Model
{
    use SoftDeletes;

    protected $table = "cor";
    protected $primaryKey = "cor_id";
    protected $dates = ['deleted_at'];
}
