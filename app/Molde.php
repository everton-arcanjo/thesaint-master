<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Molde extends Model
{
    use SoftDeletes;

    protected $table = "molde";
    protected $primaryKey = "mol_id";
    protected $dates = ['deleted_at'];
}
