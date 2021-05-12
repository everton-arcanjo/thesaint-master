<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;


class CustomUserProvider extends EloquentUserProvider
{

    public function retrieveByCredentials(array $credentials)
    {

        if (empty($credentials) ||
           (count($credentials) === 1 &&
            array_key_exists('usu_senha', $credentials))) {
            return;
        }
        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'usu_senha')) {
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }


    public function validateCredentials(UserContract $user, array $credentials)
    {
        return $this->hasher->check($credentials['usu_senha'], $user->getAuthPassword());
    }

}
