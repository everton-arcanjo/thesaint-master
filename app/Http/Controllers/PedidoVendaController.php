<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Pedido;
use App\PedidoProduto;
use App\ProdutoCaracteristica;
Use App\Cliente;
Use App\ClienteContato;
Use App\ClienteEndereco;
use App\EstoqueProduto;
use App\MateriaPrima;


class PedidoVendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:administrador_vendedor_producao');
    }

    public function index()
    {
        $filtro = \Request::input('filtro');

        if(is_null($filtro)){

            $filtro = [];

            if(Auth::user()->cli_dep_id == 4){

                $listaPedido = Pedido::where('ped_usu_id','=',Auth::user()->usu_id)->paginate(10);

            }else{

                $listaPedido = Pedido::paginate(10);

            }


        }else{

            $listaPedido = Pedido::where('ped_numero_pedido','LIKE',"%".$filtro['numero_pedido']."%");

            $listaPedido->where('ped_usu_id','=',Auth::user()->usu_id);

            if( !is_null($filtro['empresa']) || !empty($filtro['empresa']) ){

                $empresa = $filtro['empresa'];

                $listaPedido->whereHas('cliente',function($query) use ($empresa){
                    $query->where('cli_razao_social','LIKE','%'.$empresa.'%');
               });

            }

            if( !is_null($filtro['cnpj']) || !empty($filtro['cnpj']) ){

                $cnpj = $filtro['cnpj'];

                $listaPedido->whereHas('cliente', function($query) use ($cnpj){
                    $query->where('cli_cnpj','=',$cnpj);
                });

            }

            if( !is_null($filtro['data_prevista']) || !empty($filtro['data_prevista']) ){
                $listaPedido->where('ped_data_previsao','=',$filtro['data_prevista']);
            }

            if( !is_null($filtro['forma_entrega']) || !empty($filtro['forma_entrega'])){

                $listaPedido->where('ped_forma_entrega','=',$filtro['forma_entrega']);
            }

            if( !is_null($filtro['forma_pagamento']) || !empty($filtro['forma_pagamento']) ){

                $listaPedido->where('ped_forma_pagamento','=',$filtro['forma_pagamento']);
            }


            if( !is_null($filtro['status']) || !empty($filtro['status']) ){
                $listaPedido->where('ped_status_aprovacao','=',$filtro['status']);
            }

            $listaPedido = $listaPedido->paginate(10);
        }

        return view('pedidovenda.index',compact('listaPedido','filtro'));
    }


    public function create()
    {
        if(is_object(Pedido::orderBy('ped_id', 'desc')->first())){

            $numeroPedido = Pedido::orderBy('ped_id', 'desc')
                ->first()
                ->ped_id+1;
        }else {

            $numeroPedido = 1;

        }



        $numeroPedido = "SNTPED".$numeroPedido;
        return view('pedidovenda.novo',compact('numeroPedido'));
    }


    public function store(Request $request)
    {
        $pedido = $request->input('pedido');
        $cliente = $request->input('cliente');
        $produto = $request->input('produto');
        $listaProdutoPedido = [];


        if( isset($produto) && count($produto) > 0 ){

            foreach ($produto as $chaveProduto => $valorProduto) {

                $qtdLinha = count($valorProduto);

                for($c=0;$c<$qtdLinha; $c++){

                    $listaProdutoPedido[$c][$chaveProduto] = $valorProduto[$c];
                }

            }

        }


        if( isset($cliente['cli_id']) && $cliente['cli_id'] != ""){

            $objCliente = Cliente::atualiza($cliente,$cliente['cli_id']);

        }else{

            $objCliente = new Cliente();
            $objCliente->cli_cnpj = $cliente['cnpj'];
            $objCliente->cli_razao_social = $cliente['razao_socia'];
            $objCliente->cli_nome_fantasia = $cliente['nome_fantasia'];
            $objCliente->cli_inscricao_estadual = $cliente['inscricao_estadual'];
            $objCliente->cli_usu_id = Auth::user()->usu_id;
            $objCliente->save();

            $objClienteContato = new ClienteContato();
            $objClienteContato->cco_nome_contato = $cliente['contato'];
            $objClienteContato->cco_telefone_comercial = $cliente['telefone'];
            $objClienteContato->cco_celular = $cliente['celular'];
            $objClienteContato->cco_email = $cliente['email'];
            $objCliente->contato()->save($objClienteContato);

            $objClienteEndereco = new ClienteEndereco();
            $objClienteEndereco->cen_cep = $cliente['cep'];
            $objClienteEndereco->cen_endereco = $cliente['endereco'];
            $objClienteEndereco->cen_numero = $cliente['numero'];
            $objClienteEndereco->cen_complemento = $cliente['complemento'];
            $objClienteEndereco->cen_bairro = $cliente['bairro'];
            $objClienteEndereco->cen_cidade = $cliente['cidade'];
            $objClienteEndereco->cen_estado = $cliente['estado'];
            $objCliente->endereco()->save($objClienteEndereco);

        }

        $objPedido = new Pedido();
        $objPedido->ped_numero_pedido = $pedido['numero_pedido'];
        $objPedido->ped_data_pedido = $pedido['data_pedido'];
        $objPedido->ped_data_previsao = $pedido['data_prevista'];
        $objPedido->ped_forma_entrega = $pedido['forma_entrega'];
        $objPedido->ped_forma_pagamento = $pedido['forma_pagamento'];
        $objPedido->ped_observacao = $pedido['observacao'];
        $objPedido->ped_usu_id = Auth::user()->usu_id;
        $objPedido->cliente()->associate($objCliente);
        $objPedido->save();

        if( count($listaProdutoPedido) > 0 ){

            foreach($listaProdutoPedido as $produto){

                $objProdutoPedido = new PedidoProduto();
                $objProdutoPedido->ppr_qtd_pp = $produto['tamanho_pp'];
                $objProdutoPedido->ppr_qtd_p = $produto['tamanho_p'];
                $objProdutoPedido->ppr_qtd_m = $produto['tamanho_m'];
                $objProdutoPedido->ppr_qtd_g = $produto['tamanho_g'];
                $objProdutoPedido->ppr_qtd_gg = $produto['tamanho_gg'];
                $objProdutoPedido->ppr_valor_unitario = $produto['valor_unitario'];
                $objProdutoPedido->ppr_pca_id = $produto['pca_id'];
                $objProdutoPedido->pedido()->associate($objPedido);
                $objProdutoPedido->save();
            }
        }

        return redirect('\pedidovenda');
    }


    public function show($id)
    {


    }

    public function edit($id)
    {

        $objPedido = Pedido::find($id);

        if (Gate::forUser(Auth::user())->denies('permite_pedido', $objPedido)) {

            return redirect('/pedidovenda');
        }

        /*if($objPedido->ped_status_aprovacao != "AG"){

            return redirect()->back();
        }*/

        if( is_object($objPedido) ){

            $objCliente = Cliente::where('cli_id','=',$objPedido['ped_cli_id'])->first();
            
            return view('pedidovenda.editar',compact('objPedido', 'objCliente'));
        }

        return redirect('pedidovenda');
    }


    public function update(Request $request, $id)
    {
        $pedido = $request->input('pedido');
        $cliente = $request->input('cliente');
        $produto = $request->input('produto');
        $listaProdutoPedido = [];

        if( count($produto) > 0 ){

            foreach ($produto as $chaveProduto => $valorProduto) {

                $qtdLinha = count($valorProduto);

                for($c=0;$c<$qtdLinha; $c++){

                    $listaProdutoPedido[$c][$chaveProduto] = $valorProduto[$c];
                }

            }
        }

        $objPedido = Pedido::findOrFail($id);


        $objCliente = Cliente::where('cli_cnpj','=',$cliente['cnpj'])->first();

        if( is_object($objCliente) ){


            $objCliente->cli_cnpj = $cliente['cnpj'];
            $objCliente->cli_razao_social = $cliente['razao_socia'];
            $objCliente->cli_nome_fantasia = $cliente['nome_fantasia'];
            $objCliente->cli_inscricao_estadual = $cliente['inscricao_estadual'];
            $objCliente->save();

            $objClienteContato = $objCliente->contato;
            $objClienteContato->cco_nome_contato = $cliente['contato'];
            $objClienteContato->cco_telefone_comercial = $cliente['telefone'];
            $objClienteContato->cco_celular = $cliente['celular'];
            $objClienteContato->cco_email = $cliente['email'];
            $objCliente->contato()->save($objClienteContato);

            $objClienteEndereco = $objCliente->endereco;
            $objClienteEndereco->cen_cep = $cliente['cep'];
            $objClienteEndereco->cen_endereco = $cliente['endereco'];
            $objClienteEndereco->cen_numero = $cliente['numero'];
            $objClienteEndereco->cen_complemento = $cliente['complemento'];
            $objClienteEndereco->cen_bairro = $cliente['bairro'];
            $objClienteEndereco->cen_cidade = $cliente['cidade'];
            $objClienteEndereco->cen_estado = $cliente['estado'];
            $objCliente->endereco()->save($objClienteEndereco);

            $objPedido->ped_numero_pedido = $pedido['numero_pedido'];
            $objPedido->ped_data_pedido = $pedido['data_pedido'];
            $objPedido->ped_data_previsao = $pedido['data_prevista'];
            $objPedido->ped_forma_entrega = $pedido['forma_entrega'];
            $objPedido->ped_forma_pagamento = $pedido['forma_pagamento'];
            $objPedido->ped_observacao = $pedido['observacao'];
            $objPedido->ped_status_aprovacao = "AG";
            $objPedido->cliente()->associate($objCliente);
            $objPedido->save();

            if( count($listaProdutoPedido) > 0 ){

                $objPedido->pedidoproduto()->delete();
                $objPedido->save();

                foreach($listaProdutoPedido as $produto){

                    $objProdutoPedido = new PedidoProduto();
                    $objProdutoPedido->ppr_qtd_pp = $produto['tamanho_pp'];
                    $objProdutoPedido->ppr_qtd_p = $produto['tamanho_p'];
                    $objProdutoPedido->ppr_qtd_m = $produto['tamanho_m'];
                    $objProdutoPedido->ppr_qtd_g = $produto['tamanho_g'];
                    $objProdutoPedido->ppr_qtd_gg = $produto['tamanho_gg'];
                    $objProdutoPedido->ppr_valor_unitario = $produto['valor_unitario'];
                    $objProdutoPedido->ppr_pca_id = $produto['pca_id'];
                    $objProdutoPedido->pedido()->associate($objPedido);
                    $objProdutoPedido->save();
                }
            }
        }


        return redirect('\pedidovenda');
    }

    public function destroy($id)
    {
        $objPedido = Pedido::findOrFail($id);

        if($objPedido->ped_status_aprovacao != "AG"){

            return redirect()->back();
        }

        if( is_object($objPedido) ){

            $objPedido->delete();
        }

        return redirect('/pedidovenda');
    }

    public function adicionarlinha()
    {
        return view('pedidovenda.linhatabela');
    }

    public function buscacliente($id)
    {
        $objCliente = Cliente::with(['contato','endereco'])
            ->where('cli_cnpj','=',formataCNPJ($id))
            ->where('cli_usu_id','=',Auth::user()->usu_id)
            ->first();

        if( !is_null($objCliente) ){

            return $objCliente->toJson();

        }else{

            return json_encode(['erro']);

        }
    }

    public function gerarpdf($id)
    {
        $objPedido = Pedido::findOrFail($id);
        $pdf = \PDF::loadHTML(view('pedidovenda.pdf.pedidovendapdf',compact('objPedido')));
        $pdf->setPaper('a4', 'landscape');
        //return $pdf->stream();
        return $pdf->download('pedido_venda.pdf');
    }

    public function aprovarecusa(Request $request)
    {
        $decisaoPedido = $request->input('pedido');

        if( count($decisaoPedido) ){

            foreach ($decisaoPedido as $chave => $pedido) {

                $objPedido = Pedido::find($pedido['id']);

                if($objPedido->ped_status_aprovacao == 'AG'){

                    $objPedido->ped_status_aprovacao = ($pedido['decisao'] == 'S' ? 'AP' : 'RE');

                    if($objPedido->ped_status_aprovacao == 'AP'){


                        $pedidoConfirmado = [];
                        foreach($objPedido->pedidoproduto as $pedidoProduto){

                            $objEstoqueProduto = EstoqueProduto::where('epr_pca_id','=',$pedidoProduto['ppr_pca_id'])
                                ->first();

                            $objProdutoCaracteristica = ProdutoCaracteristica::where('pca_id','=',$pedidoProduto['ppr_pca_id'])
                                ->first();


                            $objMateriaPrima = MateriaPrima::where('mpr_tec_id','=',$objProdutoCaracteristica->pca_tec_id)
                                ->where('mpr_cor_id','=',$objProdutoCaracteristica->pca_cor_id)
                                ->first();

                            if(!is_object($objMateriaPrima)){

                                return json_encode([
                                    'msg' => 'erro',
                                    'msg_erro' => "Não existe estoque para o tecido {$objProdutoCaracteristica->tecido->tec_tecido} da cor {$objProdutoCaracteristica->cor->cor_cor}"
                                    ]);
                            }

                            $consumo = $objProdutoCaracteristica->molde->mol_consumo;
                            $totalConsumo = $consumo * ($pedidoProduto['ppr_qtd_pp'] + $pedidoProduto['ppr_qtd_p'] + $pedidoProduto['ppr_qtd_m'] + $pedidoProduto['ppr_qtd_g'] + $pedidoProduto['ppr_qtd_gg']);

                            $objMateriaPrima->mpr_qtd_estoque = ($objMateriaPrima->mpr_qtd_estoque - $totalConsumo);
                            $objMateriaPrima->save();

                            if(!is_null($objEstoqueProduto)){

                                $objEstoqueProduto->epr_qtd_estoque_pp = ($objEstoqueProduto->epr_qtd_estoque_pp - $pedidoProduto['ppr_qtd_pp']);
                                $objEstoqueProduto->epr_qtd_estoque_p = ($objEstoqueProduto->epr_qtd_estoque_p - $pedidoProduto['ppr_qtd_p']);
                                $objEstoqueProduto->epr_qtd_estoque_m = ($objEstoqueProduto->epr_qtd_estoque_m - $pedidoProduto['ppr_qtd_m']);
                                $objEstoqueProduto->epr_qtd_estoque_g = ($objEstoqueProduto->epr_qtd_estoque_g - $pedidoProduto['ppr_qtd_g']);
                                $objEstoqueProduto->epr_qtd_estoque_gg = ($objEstoqueProduto->epr_qtd_estoque_gg - $pedidoProduto['ppr_qtd_gg']);
                                $objEstoqueProduto->save();

                            }
                        }
                    }
                    $objPedido->save();
                }

            }

        }

        return json_encode(['msg' => 'sucesso']);
    }

}
