<?php

use App\Menu;
use App\MateriaPrima;
use App\EstoqueProduto;

if( !function_exists('formataCNPJ') ){

    function formataCNPJ($cnpj)
    {
        $y = sprintf("%014s",$cnpj);// só inclui esta linha
        $str = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})([0-9]{2})/", "$1.$2.$3/$4-$5", $y);
        return $str;
    }

}

if( !function_exists('exibeFormaEntrega') ){

    function exibeFormaEntrega($formaEntrega)
    {
       switch($formaEntrega){
        case 'LU':
            return 'Lote Único';
            break;
        case '2L':
            return '2 Lotes';
            break;
        case '3L':
            return '3 Lotes';
            break;

       }
    }

}

if( !function_exists('exibeFormaPagamento') ){

    function exibeFormaPagamento($formaPagamento)
    {
       switch($formaPagamento){
        case '1':
            return 'Dinheiro';
            break;
        case '2':
            return 'Cheque';
            break;
        case '3':
            return '30';
            break;
        case '4':
            return '30/60';
            break;
        case '5':
            return '30/60/90';
            break;
        case '6':
            return '30/60/90';
            break;

       }
    }

}

if( !function_exists('formataValor') ){

    function formataValor($valor)
    {
       return number_format($valor,2,".","");
    }

}

if( !function_exists('formataValorUnidade') ){

    function formataValorUnidade($valor,$qtdDgito = 3)
    {
       return number_format($valor,$qtdDgito,".","");
    }

}

if( !function_exists('organizaArray') ){

    function organizaArray($detalhes)
    {
        $detalheTratado = [];

        if( count($detalhes) > 0 ){

            foreach ($detalhes as $chaveDetalhe => $valorDetalhe) {

                $qtdLinha = count($valorDetalhe);

                for($c=0;$c<$qtdLinha; $c++){

                    $detalheTratado[$c][$chaveDetalhe] = $valorDetalhe[$c];
                }

            }

        }

        return $detalheTratado;

    }
}

if( !function_exists('menu') )
{

    function menu()
    {
        $authUsuario = \Auth::user();
        return Menu::with('departamento')->whereHas('departamento',function($query) use ($authUsuario){

            $query->where('dep_id','=',$authUsuario->cli_dep_id);

        })->where('mnu_ordem',"!=","")
            ->orderBy('mnu_ordem','asc')->get();
    }
}

if( !function_exists('estoqueBaixo') )
{

    function estoqueBaixo()
    {

        $total = MateriaPrima::whereRaw('mpr_qtd_estoque <= mpr_qtd_minima_estoque')->count();
        return $total;
    }
}

if( !function_exists('estoqueBaixoProduto') )
{

    function estoqueBaixoProduto()
    {

        $total = EstoqueProduto::whereRaw('(epr_qtd_minima_pp >= epr_qtd_estoque_pp) OR (epr_qtd_minima_p >= epr_qtd_estoque_p)  OR (epr_qtd_minima_m >= epr_qtd_estoque_m)  OR (epr_qtd_minima_g >= epr_qtd_estoque_g)  OR (epr_qtd_minima_gg >= epr_qtd_estoque_gg)')->count();
        return $total;
    }
}

if( !function_exists('descricaoAprovacao') )
{

    function descricaoAprovacao($status)
    {
      switch ($status) {
        case 'AG': return 'Aguardando Aprovação'; break;
        case 'AP': return 'Aprovado'; break;
        case 'RE': return 'Recusado'; break;

      }
    }
}

if( !function_exists('exibeTotalVenda') )
{

    function exibeTotalVenda($pedidovenda)
    {
        $valorTotal = 0.00;
        foreach($pedidovenda as $venda){
            $valorTotal+=$venda->ppr_qtd_pp * $venda->ppr_valor_unitario;
            $valorTotal+=$venda->ppr_qtd_p * $venda->ppr_valor_unitario;
            $valorTotal+=$venda->ppr_qtd_m * $venda->ppr_valor_unitario;
            $valorTotal+=$venda->ppr_qtd_g * $venda->ppr_valor_unitario;
            $valorTotal+=$venda->ppr_qtd_gg * $venda->ppr_valor_unitario;

        }
        return number_format($valorTotal,2,",",".");

    }
}

if( !function_exists('verificaEstoque') )
{

    function verificaEstoque($qtdMinima,$qtdAtual)
    {
        if($qtdMinima >= $qtdAtual){
            return "<i class='fas fa-exclamation-circle' data-toggle='tooltip' data-placement='top' title='Estoque Baixo'></i>";
        }

    }
}

if(!function_exists('exibeUnidade'))
{
    function exibeUnidade($unidade)
    {
        switch($unidade){
            case 'MT': return'Metro'; break;
            case 'GR': return'Grama'; break;
            case 'KG': return'Kilo'; break;
        }
    }
}




