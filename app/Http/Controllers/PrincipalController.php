<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Pedido;
use App\PedidoProduto;
use App\MetaVendedor;

use Khill\Lavacharts\Lavacharts;

class PrincipalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function principal()
    {
        $dadosPlotarGrafico = [];
        $vendaGrafico = [];

        if(Auth::user()->cli_dep_id == "1"){

            $venda = Pedido::join('usuario','pedido.ped_usu_id','=','usuario.usu_id')
                ->join('pedido_produto','pedido.ped_id','=','pedido_produto.ppr_ped_id')
                ->whereRaw("CONCAT(LPAD(MONTH(pedido.ped_data_pedido),2,'0'),YEAR(pedido.ped_data_pedido)) = ?", date("mY"))
                ->where('usuario.cli_dep_id','=','3')
                ->where('pedido_produto.deleted_at','!=',null)
                ->select('usuario.usu_nome',DB::Raw('SUM(pedido_produto.ppr_valor_unitario) as total'))
                ->groupBy('usuario.usu_nome')
                ->get();

                foreach ($venda as $chave => $dados) {
                    $vendaGrafico[] = [$dados->usu_nome,$dados->total];
                }


            if(count($vendaGrafico)){

                $lava = new Lavacharts;
                $votes  = $lava->DataTable();

                $votes->addStringColumn('Food Poll')
                    ->addNumberColumn('Venda(R$)')
                    ->addRows($vendaGrafico);


                $lava->BarChart('Votes', $votes);
            }

        }


        $valorFafurado = 0.00;
        $metaVendedorLogado = 0.00;
        $lava = null;
        $totalPedidoAprovado =  Pedido::where('ped_status_aprovacao','=','AP')
            ->whereRaw("CONCAT(LPAD(MONTH(ped_data_pedido),2,'0'),YEAR(ped_data_pedido)) = ?", date("mY"))
            ->count();

        $totalPedidoAguardando =  Pedido::where('ped_status_aprovacao','=','AG')
            ->whereRaw("CONCAT(LPAD(MONTH(ped_data_pedido),2,'0'),YEAR(ped_data_pedido)) = ?", date("mY"))
            ->count();

        $totalPedidoRecusado =  Pedido::where('ped_status_aprovacao','=','RE')
            ->whereRaw("CONCAT(LPAD(MONTH(ped_data_pedido),2,'0'),YEAR(ped_data_pedido)) = ?", date("mY"))
            ->count();

        $listaPedidoFaurado =  Pedido::with('pedidoproduto')->where('ped_status_aprovacao','=','AP')
            ->whereRaw("CONCAT(LPAD(MONTH(ped_data_pedido),2,'0'),YEAR(ped_data_pedido)) = ?", date("mY"))
            ->get();

            foreach ($listaPedidoFaurado as $chave => $valor) {
                $valorFafurado = exibeTotalVenda($valor->pedidoproduto);
            }

            if(Auth::user()->cli_dep_id == "4"){

                $vendedorVenda = [];
                $vendaGrafico = [];
                $vendas = [];

                $vendedorVenda =  Pedido::join('usuario','pedido.ped_usu_id','=','usuario.usu_id')
                    ->join('pedido_produto','pedido.ped_id','=','pedido_produto.ppr_ped_id')
                    ->where('ped_usu_id','=',Auth::user()->usu_id)
                    ->where('ped_status_aprovacao','=','AP')
                    ->whereNull('pedido_produto.deleted_at')
                    ->whereRaw("CONCAT(LPAD(MONTH(pedido.ped_data_pedido),2,'0'),YEAR(pedido.ped_data_pedido)) = ?", date("mY"))
                    ->select('pedido.ped_data_pedido','pedido_produto.ppr_pca_id',DB::Raw('SUM( (pedido_produto.ppr_qtd_pp + pedido_produto.ppr_qtd_p + pedido_produto.ppr_qtd_m + pedido_produto.ppr_qtd_g + pedido_produto.ppr_qtd_gg) * ppr_valor_unitario) as valor'))
                    ->groupBy('pedido.ped_data_pedido','pedido_produto.ppr_pca_id')
                    ->get();

                foreach ($vendedorVenda as $chave => $dados) {

                    $vendas[$dados->ped_data_pedido] = [$dados->ped_data_pedido,$dados->valor];
                }

                if(count($vendas) > 0){

                    $diaAtual = date("t");

                    for($dia=1;$dia<=$diaAtual;$dia++){
                        $dia = str_pad($dia,2,"0", STR_PAD_LEFT);
                        $dataIncremental = date("Y-m-").$dia;

                        if(isset($vendas[$dataIncremental])){

                            $vendaGrafico[] = [$vendas[$dataIncremental][0],$vendas[$dataIncremental][1]];

                        }else{

                            $vendaGrafico[] = [$dataIncremental,0.00];

                        }

                    }
                    $lava = new Lavacharts; // See note below for Laravel
                    $finances = $lava->DataTable();
                    $finances->addDateColumn('Day')
                            ->addNumberColumn('Vendas')
                            ->addRows($vendaGrafico);


                    $lava->ColumnChart('Finances', $finances);

                }


                $objMetaVendedor = MetaVendedor::where('mve_usu_id','=',Auth::user()->usu_id)
                    ->orderBy('mve_id','DESC')
                    ->first();

                if( is_object($objMetaVendedor) ){

                    $metaVendedorLogado = $objMetaVendedor->mve_valor_meta;
                }

            }


        return view('conteudo',compact('totalPedidoAprovado','totalPedidoAguardando','totalPedidoRecusado','valorFafurado','metaVendedorLogado','lava'));
    }
}
