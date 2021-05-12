<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Usuario extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = "usuario";
    protected $primaryKey = "usu_id";

    protected $dates = ['deleted_at'];
    protected $fillable = ['usu_login','usu_senha'];

    public function departamento()
    {
        return $this->hasOne('App\Departamento', 'usu_id', 'usu_dep_id');
    }

    public function getAuthPassword()
    {
        return $this->usu_senha;
    }


}
