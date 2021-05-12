<?php

namespace App;

class MateriaPrimaUtilizada
{

    static public function redefineMateriaPrimaUtilizada($materiaPrima)
    {
        $materiaPrima = [];

        foreach($materiaPrima as $mt){

            $materiaPrima[$mt->pmp_mpr_id] = ['pmp_peso' => $mt->pmp_peso,
                'pmp_unidade' => $mt->pmp_peso];

        }

        return $materiaPrima;

    }

}
