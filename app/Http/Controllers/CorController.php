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
        $filtro = [];

        if(is_null($cor) || empty($cor)){

            $listaCor = Cor::paginate(10);

        }else{

            $filtro = ['cor' => $cor];
            $listaCor = Cor::where('cor_cor', 'LIKE',"%".$cor."%")->paginate(10);
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

        $request->validate(['cor' => 'unique:cor,cor_cor'],['unique' => 'Cor já cadastrada.']);

        $objCor = new Cor();
        $objCor->cor_cor = $cor;
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
        $objCor = Cor::findOrFail($id);

        \Validator::make(['cor_cor' => $cor],[
            'cor_cor' =>[
                Rule::unique('cor')->whereNull('deleted_at')->ignore($objCor->cor_id,'cor_id')],
            ],
            ['unique' => 'Cor já cadastrada.']
        )->validate();

        if( is_object( $objCor ) ){

             $objCor->cor_cor = $cor;
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
