<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MateriaPrima;
use App\Cor;
use App\ProdutoCaracteristica;
use App\EstoqueProduto;
use App\Tecido;

class EstoqueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:administrador_producao');

    }

    public function index()
    {
        $listaCor = Cor::all();
        $listaTecido = Tecido::all();


        $filtro = \Request::input('filtro');

        if(is_null($filtro)){

            $filtro = [];
            $listaMateriaPrima = MateriaPrima::paginate(10);

        }else{


            //$listaMateriaPrima = MateriaPrima::where('mpr_cor_id','=','0');

                if( !is_null($filtro['cor']) ){

                    $listaMateriaPrima = MateriaPrima::where('mpr_cor_id','=',$filtro['cor']);
                }


                if( !is_null($filtro['tecido']) ){

                    $listaMateriaPrima = MateriaPrima::where('mpr_tec_id','=',$filtro['tecido']);

                }

                if(!isset($listaMateriaPrima)){

                    $listaMateriaPrima = MateriaPrima::paginate(10);

                }else{

                    $listaMateriaPrima = $listaMateriaPrima->paginate(10);

                }

        }

        return view('estoque.index',compact('listaMateriaPrima','filtro','listaCor','listaTecido'));
    }

    public function indexproduto()
    {
        $listaCor = Cor::all();
        $listaProduto = ProdutoCaracteristica::paginate(10);
        return view('estoque.indexproduto',compact('listaProduto','listaCor'));
    }

    public function editproduto($id)
    {
        $objProduto = ProdutoCaracteristica::find($id);
        $objEstoqueProduto = EstoqueProduto::where('epr_pca_id','=',$id)->first();

        return view('estoque.editarproduto',compact('objProduto','objEstoqueProduto'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function updateestoque(Request $request, $id)
    {
        $dadosEstoque = $request->input('estoque');
        //echo "<pre>";
        //print_r($dadosEstoque);
        //exit;

        $objEstoqueProduto = EstoqueProduto::where('epr_pca_id','=',$id)->first();

        if(is_null($objEstoqueProduto)){

            $objEstoqueProduto = new EstoqueProduto();
        }

        $objEstoqueProduto->epr_qtd_minima_pp = $dadosEstoque['pp_min'];
        $objEstoqueProduto->epr_qtd_maxima_pp = 0;
        $objEstoqueProduto->epr_qtd_estoque_pp = $dadosEstoque['pp_estoque'];
        $objEstoqueProduto->epr_qtd_minima_p = $dadosEstoque['p_min'];
        $objEstoqueProduto->epr_qtd_maxima_p = 0;
        $objEstoqueProduto->epr_qtd_estoque_p = $dadosEstoque['p_estoque'];
        $objEstoqueProduto->epr_qtd_minima_m = $dadosEstoque['m_min'];
        $objEstoqueProduto->epr_qtd_maxima_m = 0;
        $objEstoqueProduto->epr_qtd_estoque_m = $dadosEstoque['m_estoque'];
        $objEstoqueProduto->epr_qtd_minima_g = $dadosEstoque['g_min'];
        $objEstoqueProduto->epr_qtd_maxima_g = 0;
        $objEstoqueProduto->epr_qtd_estoque_g = $dadosEstoque['g_estoque'];
        $objEstoqueProduto->epr_qtd_minima_gg = $dadosEstoque['gg_min'];
        $objEstoqueProduto->epr_qtd_maxima_gg = 0;
        $objEstoqueProduto->epr_qtd_estoque_gg = $dadosEstoque['gg_estoque'];
        $objEstoqueProduto->epr_pca_id = $id;
        $objEstoqueProduto->save();

        return redirect('estoqueproduto/indexproduto');

    }


    public function destroy($id)
    {
        //
    }
}
