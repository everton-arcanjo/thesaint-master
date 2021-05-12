<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProduto;
use App\TipoProdutoModelo;

class TipoProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $listaTipoProduto = TipoProduto::all();

        return view('tipoproduto.index',compact('listaTipoProduto'));
    }

    public function create()
    {
        return view('tipoproduto.novo');
    }


    public function store(Request $request)
    {
        $dadosForm = $request->input('tipoProduto');
        $dadosFormModelo = $request->input('tipoProdutoModelo');
        $detalheModelo = [];

        foreach ($dadosFormModelo as $chaveModelo => $valorModelo) {

            $qtdLinha = count($valorModelo);

            for($c=0;$c<$qtdLinha; $c++){

                $detalheModelo[$c][$chaveModelo] = $valorModelo[$c];
            }

        }


        if( count( $detalheModelo ) > 0 ){

            $objTipoProduto = new TipoProduto();
            $objTipoProduto->tpr_codigo = $dadosForm['codigo'];
            $objTipoProduto->tpr_tipo_produto = $dadosForm['tipo'];
            $objTipoProduto->save();

            foreach ($detalheModelo as $chaveModelo => $valorModelo) {

                $objTipoProdutoModelo = new TipoProdutoModelo();
                $objTipoProdutoModelo->tpm_codigo = $valorModelo['modelo'];
                $objTipoProdutoModelo->tpm_modelo = $valorModelo['modelo'];
                $objTipoProdutoModelo->tpm_tpr_id = $objTipoProduto->tpr_id;
                $objTipoProdutoModelo->save();
                //$objTipoProduto->modelo->save($objTipoProdutoModelo);
            }
        }

        return redirect('/tipoproduto');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $objTipoProduto = TipoProduto::findOrFail($id);
        if( is_object($objTipoProduto) ){

            return view('tipoproduto.edit',compact('objTipoProduto'));
        }

        return redirect('/tipoproduto');
    }


    public function update(Request $request, $id)
    {

        $objTipoProduto = TipoProduto::findOrFail($id);
        if( is_object($objTipoProduto) ){

            $dadosFormTipoProduto = $request->input('tipoProduto');
            $dadosFormTipoProdutoModelo = $request->input('tipoProdutoModelo');

            $objTipoProduto->tpr_codigo = $dadosFormTipoProduto['codigo'];
            $objTipoProduto->tpr_tipo_produto = $dadosFormTipoProduto['tipo'];
            $objTipoProduto->save();

        }

        return redirect('/tipoproduto');
    }

    public function destroy($id)
    {
        //
    }
}
