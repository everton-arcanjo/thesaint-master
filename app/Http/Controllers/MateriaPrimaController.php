<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MateriaPrima as MateriaPrimaModel;
Use App\MateriaPrimaCompra;
Use App\MateriaPrimaItem;
use App\Fornecedor;
use App\Cor;
use App\Tecido;
use App\PedidoProduto;
use App\ProdutoCaracteristica;



class MateriaPrimaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('can:administrador_producao');
    }

    public function index()
    {
        return redirect('/materiaprima/create');
    }


    public function create()
    {
        $listaCor = Cor::all();
        $listaTecido = Tecido::all();

        return view('materiaprima.novo',compact('listaCor','listaTecido'));
    }


    public function store(Request $request)
    {

        $request->validate(['qtdMinimaEstoque' => 'required'],
            ['required' => 'O campo :attribute e obrigatório']);

        $objMateriaPrimaModel = new MateriaPrimaModel();
        $objMateriaPrimaModel->mpr_cor_id = $request->input('cor');
        $objMateriaPrimaModel->mpr_tec_id = $request->input('tecido');
        $objMateriaPrimaModel->mpr_qtd_minima_estoque = $request->input('qtdMinimaEstoque');
        $objMateriaPrimaModel->save();

        return redirect('/estoque');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $objMateriaPrima = MateriaPrimaModel::with(['cor','tecido'])->where('mpr_id','=',$id)->first();

        if( is_object($objMateriaPrima) ){

            return $objMateriaPrima->toJson();
        }

        return json_encode(['erro' => true],200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $listaCor = Cor::all();
        $listaTecido = Tecido::all();
        $listaPedidoProduto = null;
        $listaMateriaPrimaCompra = null;

        $objMateriaPrima = MateriaPrimaModel::findOrFail($id);

        if( is_object($objMateriaPrima) ){

            $objProdutoCaracteristica = ProdutoCaracteristica::where('pca_tec_id','=',$objMateriaPrima->mpr_tec_id)
                ->where('pca_cor_id','=',$objMateriaPrima->mpr_cor_id)
                ->first();

                if(!is_null($objProdutoCaracteristica)){

                    $listaPedidoProduto = PedidoProduto::where('ppr_pca_id','=',$objProdutoCaracteristica->pca_id)
                        ->wherehas('pedido',function($query){
                                $query->where('ped_status_aprovacao','=','AP');
                            })
                        ->paginate(5);


                }

                $listaMateriaPrimaCompra = MateriaPrimaItem::where('mpi_cor_id','=',$objMateriaPrima->mpr_cor_id)
                    ->where('mpi_tec_id','=',$objMateriaPrima->mpr_tec_id)
                    ->paginate(5);


            return view('materiaprima.editar',compact('objMateriaPrima','listaCor','listaTecido','listaPedidoProduto','listaMateriaPrimaCompra'));
        }

        return redirect('/estoque');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['qtdMinimaEstoque' => 'required'],
            ['required' => 'O campo :attribute e obrigatório']);

        $objMateriaPrima = MateriaPrimaModel::findOrFail($id);
        if( is_object($objMateriaPrima) ){

            //$objMateriaPrima->mpr_cor_id = $request->input('cor');
            //$objMateriaPrima->mpr_tec_id = $request->input('tecido');
            $objMateriaPrima->mpr_qtd_minima_estoque = str_replace(",",".",$request->input('qtdMinimaEstoque'));
            $objMateriaPrima->save();

        }

        return redirect('/estoque');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $objMateriaPrimaCompra = MateriaPrimaCompra::find($id);

        if( is_object($objMateriaPrimaCompra) ){

            $objMateriaPrimaCompra->delete();
        }

        return redirect('/estoque');
    }

    public function compra()
    {
        $filtro = \Request::input('filtro');
        $listaFornecedor = Fornecedor::all();

        if(is_null($filtro)){
            $filtro = [];
            $listaMateriaPrimaCompra = MateriaPrimaCompra::paginate(10);

        }else{


            $listaMateriaPrimaCompra = MateriaPrimaCompra::where('mtc_numero_pedido','LIKE','%'.$filtro['codigo_produto'].'%');

            if(isset($filtro['data']) && !empty($filtro['data'])){

                $listaMateriaPrimaCompra->where('mtc_data', '=',$filtro['data']);
            }

            if(isset($filtro['materia_prima']) && !empty($filtro['materia_prima'])){

                $nomeMateriaPrima = $filtro['materia_prima'];

                $listaMateriaPrimaCompra->whereHas('materiaprima',function($query) use ($nomeMateriaPrima){
                    $query->where('mpr_nome', 'LIKE','%'.$nomeMateriaPrima.'%');
                });
            }

            if(isset($filtro['prazo']) && !empty($filtro['prazo'])){

                $listaMateriaPrimaCompra->where('prazo', '=',$filtro['prazo']);
            }

            if(isset($filtro['previsao_recebimento']) && !empty($filtro['previsao_recebimento'])){

                $listaMateriaPrimaCompra->where('mtc_data_previsao', '=',$filtro['previsao_recebimento']);

            }

            $listaMateriaPrimaCompra = $listaMateriaPrimaCompra->paginate(10);
        }

        return view('materiaprima.compra',compact('listaMateriaPrimaCompra','listaFornecedor'));
    }

    public function lancarcompra(Request $request)
    {

        if( $request->input('idMateriaPrimaCompra') != "" ){

            $idMateriaPrimaCompra = $request->input('idMateriaPrimaCompra');
            $objMateriaPrima = MateriaPrimaCompra::findOrFail($idMateriaPrimaCompra);

        }else{

            $objMateriaPrima = new MateriaPrimaCompra();
        }

        $objMateriaPrima->mtc_numero_pedido = $request->input('numeroPedidoMateriaPrima');
        $objMateriaPrima->mtc_data = $request->input('dataEstoque');
        $objMateriaPrima->mtc_for_id = $request->input('fornecedor');
        $objMateriaPrima->prazo = $request->input('prazo');
        $objMateriaPrima->mtc_data_previsao = $request->input('previsaoRecebimento');
        $objMateriaPrima->mtc_quantidade = $request->input('quantidade');
        $objMateriaPrima->mtc_mpr_id = $request->input('idMateriaPrima');
        $objMateriaPrima->save();

        return $objMateriaPrima->toJson();

    }


    public function showMateriaPrimaCompra($id){


        $materiaPrimaCompra = MateriaPrimaCompra::with(['materiaprima','fornecedor'])->where('mtc_id','=',$id)->first();
        return $materiaPrimaCompra->toJson();

    }

    public function novacompra()
    {
        $listaFornecedor = Fornecedor::all();
        $listaMateriaPrimaCompra = MateriaPrimaCompra::all();
        $listaCor = Cor::all();
        $listaTecido = Tecido::all();
        return view('materiaprima.novacompra',compact('listaFornecedor','listaCor','listaTecido'));
    }

    public function salvarnovacompra(Request $request)
    {
        $dadosForm = $request->input('compra');
        $produto = $request->input('produto');
        $produtos = organizaArray($produto);


        /*
        $objMateriaPrima = MateriaPrimaModel::where('mpr_tec_id','=',$dadosForm['tecido'])
            ->where('mpr_cor_id','=',$dadosForm['cor'])
            ->first();

        if(!is_object($objMateriaPrima)){

            $objMateriaPrima = new MateriaPrimaModel();
            $objMateriaPrima->mpr_tec_id = $dadosForm['tecido'];
            $objMateriaPrima->mpr_cor_id = $dadosForm['cor'];
            $objMateriaPrima->mpr_qtd_estoque = $dadosForm['quantidade'];

        }else{

            $objMateriaPrima->mpr_qtd_estoque+=$dadosForm['quantidade'];
        }

        $objMateriaPrima->save();*/

        $objMateriaPrimaCompra = new MateriaPrimaCompra();
        $objMateriaPrimaCompra->mtc_numero_pedido = $dadosForm['numero_pedido'];
        $objMateriaPrimaCompra->mtc_data = $dadosForm['data_estoque'];
        $objMateriaPrimaCompra->prazo = $dadosForm['prazo'];
        $objMateriaPrimaCompra->mtc_data_previsao = $dadosForm['previsao_recebimento'];
        $objMateriaPrimaCompra->save();


        foreach($produtos as $produto){

            $objMateriaPrimaItem = new MateriaPrimaItem();
            $objMateriaPrimaItem->mpi_tec_id = $produto['tecido'];
            $objMateriaPrimaItem->mpi_cor_id = $produto['cor'];
            $objMateriaPrimaItem->mpi_for_id = $produto['fornecedor'];
            $objMateriaPrimaItem->mtc_quantidade = $produto['quantidade'];

            $objMateriaPrimaCompra->item()->save($objMateriaPrimaItem);
        }


        return redirect('/compra');
    }

    public function showcompra($id)
    {
        $listaCor = Cor::all();
        $listaTecido = Tecido::all();
        $objMateriaPrimaCompra = MateriaPrimaCompra::find($id);
        $listaMateriaPrimaItem = MateriaPrimaItem::where('mpi_mtc_id','=',$id)->get();

        $listaFornecedor = Fornecedor::all();

        if(!is_object($objMateriaPrimaCompra)){

            return redirect('/compra');
        }

        return view('materiaprima.editarmateriaprima',compact('objMateriaPrimaCompra','listaFornecedor','listaCor','listaTecido','listaMateriaPrimaItem'));

    }

    public function atualizacompra(Request $request, $id)
    {
        $objMateriaPrimaCompra = MateriaPrimaCompra::find($id);
        $itens = [];

        if(!is_object($objMateriaPrimaCompra)){

            return redirect('/compra');
        }

        $dadosForm = $request->input('compra');
        $produto = $request->input('produto');

        $produtos = organizaArray($produto);

        $objMateriaPrimaCompra->mtc_numero_pedido = $dadosForm['numero_pedido'];
        $objMateriaPrimaCompra->mtc_data = $dadosForm['data_estoque'];
        $objMateriaPrimaCompra->prazo = $dadosForm['prazo'];
        $objMateriaPrimaCompra->mtc_data_previsao = $dadosForm['previsao_recebimento'];
        $objMateriaPrimaCompra->save();

        if(count($produtos)){

            foreach($produtos as $produto){

                if(isset( $produto['id_item'] )){

                    $itens[$produto['id_item']] = $produto['id_item'];

                    $objMateriaPrimaItem =  MateriaPrimaItem::findOrFail($produto['id_item']);
                    $objMateriaPrimaItem->mpi_tec_id = $produto['tecido'];
                    $objMateriaPrimaItem->mpi_cor_id = $produto['cor'];
                    $objMateriaPrimaItem->mpi_for_id = $produto['fornecedor'];
                    $objMateriaPrimaItem->mtc_quantidade = $produto['quantidade'];
                    $objMateriaPrimaItem->save();

                }else{

                    $objMateriaPrimaItem =  new MateriaPrimaItem();
                    $objMateriaPrimaItem->mpi_tec_id = $produto['tecido'];
                    $objMateriaPrimaItem->mpi_cor_id = $produto['cor'];
                    $objMateriaPrimaItem->mpi_for_id = $produto['fornecedor'];
                    $objMateriaPrimaItem->mtc_quantidade = $produto['quantidade'];
                    $objMateriaPrimaCompra->item()->save($objMateriaPrimaItem);
                }

            }
        }

        $listaItem = MateriaPrimaItem::whereNotIn('mpi_id',$itens)
            ->delete();

        return redirect('/compra');
    }

    public function adicionarLinha()
    {
        $listaCor = Cor::all();
        $listaTecido = Tecido::all();
        $listaFornecedor = Fornecedor::all();

        return view('materiaprima/adicionarLinha',compact('listaFornecedor','listaCor','listaTecido'));

    }

}
