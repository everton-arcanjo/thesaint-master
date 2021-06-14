<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MetaVendedor;
use App\Usuario;
use  App\Rules\PeriodoMeta;

class MetaController extends Controller
{

    public function index()
    {
        $filtro = \Request::input('filtro');

        if(is_null($filtro)){

            $filtro = [];
            $listaMeta = MetaVendedor::paginate(10);

        }else{

            $nomeVendedor = $filtro['vendedor'];

            $listaMeta = MetaVendedor::whereHas('vendedor', function($query) use ($nomeVendedor) {
                $query->where('usu_nome','LIKE','%'.$nomeVendedor.'%');
            });


            if(!empty($filtro['data_inicio']) && !empty($filtro['data_fim'])){
                $listaMeta->where('mve_data_inicio', '>=', $filtro['data_inicio'])
                ->where('mve_data_inicio', '<=', $filtro['data_fim']);
            }

            if(!empty($filtro['valor'])){

                $filtro['valor'] = str_replace([',','.'],"",$filtro['valor']) / 100;
                $listaMeta->where('mve_valor_meta', '=', $filtro['valor']);

            }

            $listaMeta = $listaMeta->paginate(10);
        }

        return view('meta.index',compact('listaMeta'));
    }


    public function create()
    {
        $listaVendedor = Usuario::where('cli_dep_id','=',3)->get();

        return view('meta.novo',compact('listaVendedor'));

    }


    public function store(Request $request)
    {
        $meta = $request->input('meta');

        $request->validate([
            'meta.data_inicio' => [new PeriodoMeta($meta['data_fim'],$meta['vendedor'])],
        ]);

        $valorMeta =  str_replace(['.',","],"",$meta['valor_meta']);
        $valorMeta = $valorMeta/100;
        $valorMeta = number_format($valorMeta,2,".","");

        $objMetaVendedor = new MetaVendedor();
        $objMetaVendedor->mve_data_inicio = $meta['data_inicio'];
        $objMetaVendedor->mve_data_fim = $meta['data_fim'];
        $objMetaVendedor->mve_valor_meta = $valorMeta;
        $objMetaVendedor->mve_usu_id = $meta['vendedor'];
        $objMetaVendedor->save();

        return redirect("/meta");

    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $listaVendedor = Usuario::where('cli_dep_id','=',3)->get();
        $objMeta = MetaVendedor::findOrFail($id);
        return view('meta.editar',compact('listaVendedor','objMeta'));
    }


    public function update(Request $request, $id)
    {
        $meta = $request->input('meta');

        $request->validate([
            'meta.data_inicio' => [new PeriodoMeta($meta['data_fim'],$meta['vendedor'],$id)],
        ]);

        $valorMeta =  str_replace(['.',","],"",$meta['valor_meta']);
        $valorMeta = $valorMeta/100;
        $valorMeta = number_format($valorMeta,2,".","");

        $objMetaVendedor = MetaVendedor::findOrFail($id);
        $objMetaVendedor->mve_data_inicio = $meta['data_inicio'];
        $objMetaVendedor->mve_data_fim = $meta['data_fim'];
        $objMetaVendedor->mve_valor_meta = $valorMeta;
        $objMetaVendedor->mve_usu_id = $meta['vendedor'];
        $objMetaVendedor->save();

        return redirect("/meta");
    }


    public function destroy($id)
    {

    }
}
