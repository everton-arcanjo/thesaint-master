<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;


use App\Tecido;


class TecidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:administrador_producao');

    }

    public function index()
    {
        $tecido = \Request::input('tecido');
        $filtro = [];
        if(is_null($tecido) || empty($tecido) ){

            $listaTecido = Tecido::paginate(10);

        }else{

            $filtro = ['tecido' => $tecido];
            $listaTecido = Tecido::where('tec_tecido','LIKE','%'.$tecido.'%')
                ->paginate(10);
        }

        return view('tecido.index',compact('listaTecido','filtro'));
    }


    public function create()
    {
        return view('tecido.novo');
    }


    public function store(Request $request)
    {

        $requestTecido = $request->input("tecido");
        $requestUnidade = $request->input("unidade");

        $request->validate(['tecido' => 'unique:tecido,tec_tecido'],
        ['unique' => 'Tecido ja cadastrado.']);


        $objTecido = new Tecido();
        $objTecido->tec_tecido = $requestTecido;
        $objTecido->tec_unidade = $requestUnidade;
        $objTecido->save();

        return redirect('/tecido');
    }


    public function show($id)
    {
        $objTecido = Tecido::findOrFail($id)->first();
        return $objTecido;

    }


    public function edit($id)
    {
        $objTecido = Tecido::findOrFail($id);
        if( is_object($objTecido) ){

            return view('tecido.editar',compact('objTecido'));
        }

        return redirect('/tecido');
    }


    public function update(Request $request, $id)
    {
        $requestTecido = $request->input("tecido");

        $objTecido = Tecido::findOrFail($id);

        \Validator::make(['tec_tecido' => $requestTecido['tecido']],[
            'tec_tecido' =>[
                Rule::unique('tecido','tec_tecido')->whereNull('deleted_at')->ignore($objTecido->tec_id,'tec_id')],
            ],
            ['unique' => 'Tecido já cadastrado.']
        )->validate();

        if( is_object( $objTecido ) ){

             //$objTecido->tec_codigo = $requestTecido['codigo'];
             $objTecido->tec_tecido = $requestTecido['tecido'];
             $objTecido->tec_unidade = $requestTecido['unidade'];
             $objTecido->save();

         }

        return redirect('/tecido');
    }


    public function destroy($id)
    {
        $objTecido = Tecido::findOrFail($id);
        $objTecido->delete();
        return redirect('/tecido');
    }
}
