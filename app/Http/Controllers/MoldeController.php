<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Molde;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class MoldeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('auth:api');
        //$this->middleware('can:administrador_producao');

    }

    public function index()
    {
        $filtro = [];
        $molde = \Request::input('molde');

        if( is_null($molde) || empty($molde) ){

            $listaMolde = Molde::paginate(10);

        }else{

            $filtro = ['molde' => $molde];
            $listaMolde = Molde::where('mol_molde','LIKE','%'.$molde.'%')
                ->paginate(10);
        }

        return view('molde.index',compact('listaMolde','filtro'));
    }


    public function create()
    {
        return view('molde.novo');
    }


    public function store(Request $request)
    {
        $molde = $request->input("molde");
        $consumo = $request->input("consumo");
        $unidade = $request->input("unidade");

        \Validator::make(['mol_molde' => $molde],[
            'mol_molde' =>[
                Rule::unique('molde','mol_molde')->whereNull('deleted_at')]
             ],
            ['unique' => 'Molde já cadastrado.']
            )->validate();

        $objMolde = new Molde();
        //$objMolde->mol_codigo = $requestMolde['codigo'];
        $objMolde->mol_molde = $molde;
        $objMolde->mol_consumo = str_replace(",",".",$consumo);
        $objMolde->mol_unidade = $unidade;
        $objMolde->save();

        return redirect('/molde');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $objMolde = Molde::findOrFail($id);
        if( is_object($objMolde) ){

            return view('molde.editar',compact('objMolde'));
        }

        return redirect('/molde');
    }


    public function update(Request $request, $id)
    {

       $molde = $request->input("molde");
       $consumo = $request->input("consumo");
       $unidade = $request->input("unidade");
       $objMolde = Molde::findOrFail($id);

       \Validator::make(['mol_molde' => $molde],[
           'mol_molde' =>[
               Rule::unique('molde','mol_molde')->whereNull('deleted_at')->ignore($objMolde->mol_id,'mol_id')]
            ],
           ['unique' => 'Molde já cadastrado.']
           )->validate();

       if( is_object( $objMolde ) ){

            //$objMolde->mol_codigo = $requestMolde['codigo'];
            $objMolde->mol_molde = $molde;
            $objMolde->mol_consumo = str_replace(",",".",$consumo);
            $objMolde->mol_unidade = $unidade;
            $objMolde->save();

        }

       return redirect('/molde');

    }


    public function destroy($id)
    {
        $objMolde = Molde::findOrFail($id);
        $objMolde->delete();
        return redirect('/molde');
    }

    public function showjson($id)
    {
        $objMolde = Molde::find($id);

        if( !is_null($objMolde) ){

            return $objMolde->toJson();
        }

    }
}
