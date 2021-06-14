<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

use App\Cor;

class CorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:administrador_producao');

    }

    public function index()
    {
        $cor = \Request::input('cor');
        $codigo_cor = \Request::input('codigo_cor');
        $filtro = [];

        if(is_null($cor) || empty($cor)){

            $listaCor = Cor::paginate(10);

        }else{

            $filtro = ['cor' => $cor];
            $filtro = ['codigo_cor' => $codigo_cor];
            $listaCor = Cor::where('cor_cor', 'LIKE',"%".$cor."%")->
            where('codigo_cor', 'LIKE',"%".$codigo_cor."%")->paginate(10);
        }

        return view('cor.index',compact('listaCor','filtro'));
    }


    public function create()
    {
        return view('cor.novo');
    }

    public function store(Request $request)
    {
        $cor = $request->input("cor");
        $codigo_cor = $request->input("codigo_cor");

        $request->validate(['cor' => 'unique:cor,cor_cor', 'codigo_cor' => 'unique:cor,codigo_cor'],['unique' => 'Cor já cadastrada.']);

        $objCor = new Cor();
        $objCor->cor_cor = $cor;
        $objCor->codigo_cor = $codigo_cor;
        $objCor->save();

        return redirect('/cor');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $objCor = Cor::findOrFail($id);

        if( is_object($objCor) ){

            return view('cor.editar',compact('objCor'));
        }

        return redirect('/cor');
    }


    public function update(Request $request, $id)
    {
        $cor = $request->input("cor");
        $codigo_cor = $request->input("codigo_cor");
        $objCor = Cor::findOrFail($id);

        \Validator::make(['cor_cor' => $cor],[
            'cor_cor' =>[
                Rule::unique('cor')->whereNull('deleted_at')->ignore($objCor->cor_id,'cor_id')],
            ],
            ['unique' => 'Cor já cadastrada.']
        )->validate();

        \Validator::make(['codigo_cor' => $codigo_cor],[
            'codigo_cor' =>[
                Rule::unique('cor')->whereNull('deleted_at')->ignore($objCor->cor_id,'cor_id')],
            ],
            ['unique' => 'Codigo já cadastrado.']
        )->validate();        

        if( is_object( $objCor ) ){

             $objCor->cor_cor = $cor;
             $objCor->codigo_cor = $codigo_cor;
             $objCor->save();

         }

        return redirect('/cor');
    }


    public function destroy($id)
    {
        $objCor = Cor::findOrFail($id);
        $objCor->delete();
        return redirect('/cor');

    }
}
