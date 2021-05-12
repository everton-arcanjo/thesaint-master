<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProdutoFinal;
use App\MateriaPrima;
use App\ProdutoFinalMateriaPrima;
use App\MateriaPrimaUtilizada;


class ProdutoFinalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $listaProduto = ProdutoFinal::all();
        return view('produto.index',compact('listaProduto'));
    }


    public function create()
    {
        $listaMateriaPrima = MateriaPrima::all();
        return view('produto.novo',compact('listaMateriaPrima'));
    }


    public function store(Request $request)
    {
        ProdutoFinal::salvarProdutoFinal($request);
        return redirect('produto');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $produto = ProdutoFinal::findOrFail($id);
        if( is_object($produto) ){

            $materiaPrima = [];
            $listaMateriaPrima = MateriaPrima::all();
            $produtoMateriaPrima = ProdutoFinalMateriaPrima::where('pmp_pfi_id','=',$id)->get();


            foreach($produtoMateriaPrima as $mt){

                $materiaPrimaUtilizada[$mt->pmp_mpr_id] = ['pmp_peso' => $mt->pmp_peso,
                    'pmp_unidade' => $mt->pmp_unidade];

            }

            return view('produto.editar',compact('listaMateriaPrima','produto','materiaPrimaUtilizada'));
        }

        return redirect('/produto');

    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
