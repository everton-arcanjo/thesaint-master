<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\MetaVendedor;

class PeriodoMeta implements Rule
{
    private $dataFim;
    private $vendedor;
    private $meta;

    public function __construct($dataFim,$vendedor,$meta = null)
    {
        $this->dataFim = $dataFim;
        $this->vendedor = $vendedor;
        $this->meta = $meta;
    }


    public function passes($attribute, $value)
    {
        $perido = MetaVendedor::where('mve_usu_id','=',$this->vendedor)
            ->where('mve_data_inicio','>=',$value)
            ->where('mve_data_fim','<=',$this->dataFim);
            if(!is_null($this->meta)){
                $perido->where('mve_id','!=',$this->meta);
            }

            $result = $perido->first();

            if(is_null($result)){
                return true;
            }


    }


    public function message()
    {
        return 'Período já informado';
    }
}
