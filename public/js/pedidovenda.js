$(document).ready(function(){
    $('#pedidoClienteCnpj').mask('00.000.000/0000-00', {reverse: true});
    $('#pedidoClienteTelefone').mask('(00) 0000-0000');
    $('#pedidoClienteCelular').mask('(00) 0 0000-0000');
    $('#pedidoClienteNumero').mask('00000');
    $('#pedidoClienteCep').mask('00000-000');

    validaAbaPedidoGeral();
    somaGeral();

});


$("#adicionarLinhaPedidoVenda").click(function(){

    $.ajax({
        type: 'GET',
        url: '/pedidovenda/adicionarlinha',
        dataType: 'html',
        context: this,
        success: function( response ){

            $("#listaPedido tbody").append( response );
            $("input[name='pedidovenda[valor_unitario][]']").mask('000.000.000.000.000,00', {reverse: true});

        },
        error: function(){

        }
    })
});

function buscaInfoProduto(obj)
{
    let codigo = $(obj).val();
    let resultado = true;
    $("#msgUsuario").html("");
    $.getJSON('/api/produto/info/'+codigo, function( response ){

        var row_index = $(obj).closest("tr");

        if( response.pca_id != undefined){

            resultado = verificaProdutoDuplicidade(codigo);

            if(resultado){

                row_index[0].cells[0].children[1].value = response.pca_id;
                 row_index[0].cells[1].children[0].value = response.produto.pro_tipo;
                 row_index[0].cells[2].children[0].value = response.molde.mol_molde;
                 row_index[0].cells[3].children[0].value = response.cor.cor_cor;
                 row_index[0].cells[4].children[0].value = response.tecido.tec_tecido;
                 $(row_index[0].cells[5].children[0]).removeAttr('readonly');
                 $(row_index[0].cells[6].children[0]).removeAttr('readonly');
                 $(row_index[0].cells[7].children[0]).removeAttr('readonly');
                 $(row_index[0].cells[8].children[0]).removeAttr('readonly');
                 $(row_index[0].cells[9].children[0]).removeAttr('readonly');
                 $(row_index[0].cells[10].children[0]).removeAttr('readonly');
                 row_index[0].cells[11].children[0].value = response.pca_valor;

            }else{

                row_index[0].remove();
                $("#msgUsuario").html(msgDanger("Produto Duplicado"));
            }
        }else{

            row_index[0].remove();
            $("#msgUsuario").html(msgDanger("Produto não cadastrado"));
        }


    });
}

function verificaProdutoDuplicidade(codigo)
{
    let linha = $("#listaPedido>tbody>tr");
    let codigoProduto = null;
    let contador = null;
    if( linha.length > 0 ){

         linha.each(function(chave,elemento){
            codigoProduto = $.trim(elemento.cells[0].children[0].value);
            if(codigoProduto == codigo){

                contador++;
            }

        });

        if(contador > 1){
            return false;
        }else{
            return true;
        }
     }
}

function somaPeca( obj )
{
    let totalQtdPeca = 0;

    let row_index = $(obj).closest("tr");

    let pp = parseInt(row_index[0].cells[5].children[0].value);
    let p =  parseInt(row_index[0].cells[6].children[0].value);
    let m =  parseInt(row_index[0].cells[7].children[0].value);
    let g =  parseInt(row_index[0].cells[8].children[0].value);
    let gg = parseInt(row_index[0].cells[9].children[0].value);

    let valorUnitario = parseFloat(row_index[0].cells[11].children[0].value).toFixed(2);

    totalQtdPeca = pp+p+m+g+gg;
    row_index[0].cells[10].children[0].value = totalQtdPeca;
    let valorTotal =  valorUnitario*totalQtdPeca;
    valorTotal = parseFloat(valorTotal).toFixed(2);
    row_index[0].cells[12].children[0].value = valorTotal;

    $("input[name='pedidovenda[valor_total][]']").mask('000.000.000.000.000,00', {reverse: true});

    somaGeral();

}

function somaGeral()
{
   let linha = $("#listaPedido>tbody>tr");
   let totalPedido = null;
   let totalProduto = 0.00;
   if( linha.length > 0 ){

        linha.each(function(chave,elemento){

            totalProduto = parseFloat(elemento.cells[12].children[0].value.replace(",",""));
            totalPedido = totalPedido + totalProduto;
        });

        $("#valorTotalPedido").val(totalPedido.toFixed(2));

    }else{

        $("#valorTotalPedido").val(totalProduto.toFixed(2));

   }


}

function removerLinhaPedido( obj )
{
    var row_index = $(obj).closest("tr").remove();
    somaGeral();

}

$("#pedidoClienteCnpj").change(function(){

    let cnpj = $.trim( $(this).val() ).replace('.','').replace('.','').replace('/','').replace('-','');

    if(cnpj != ""){

        $.getJSON('/pedidovenda/buscacliente/'+cnpj,function( cliente ){

            $("input[name='cliente[cli_id]']").val("");
            $("input[name='cliente[razao_socia]']").val("");
            $("input[name='cliente[nome_fantasia]']").val("");
            $("input[name='cliente[inscricao_estadual]']").val("");
            $("input[name='cliente[contato]']").val("");
            $("input[name='cliente[telefone]']").val("");
            $("input[name='cliente[celular]']").val("");
            $("input[name='cliente[email]']").val("");

            $("input[name='cliente[cep]']").val("");
            $("input[name='cliente[endereco]']").val("");
            $("input[name='cliente[numero]']").val("");
            $("input[name='cliente[complemento]']").val("");
            $("input[name='cliente[bairro]']").val("");
            $("input[name='cliente[cidade]']").val("");
            $("input[name='cliente[estado]']").val("");

            if(cliente != 'erro'){

                $("input[name='cliente[cli_id]']").val(cliente.cli_id);
                $("input[name='cliente[razao_socia]']").val(cliente.cli_razao_social);
                $("input[name='cliente[nome_fantasia]']").val(cliente.cli_nome_fantasia);
                $("input[name='cliente[inscricao_estadual]']").val(cliente.cli_inscricao_estadual);
                $("input[name='cliente[contato]']").val(cliente.contato.cco_nome_contato);
                $("input[name='cliente[telefone]']").val(cliente.contato.cco_telefone_comercial);
                $("input[name='cliente[celular]']").val(cliente.contato.cco_celular);
                $("input[name='cliente[email]']").val(cliente.contato.cco_email);

                $("input[name='cliente[cep]']").val(cliente.endereco.cen_cep);
                $("input[name='cliente[endereco]']").val(cliente.endereco.cen_endereco);
                $("input[name='cliente[numero]']").val(cliente.endereco.cen_numero);
                $("input[name='cliente[complemento]']").val(cliente.endereco.cen_complemento);
                $("input[name='cliente[bairro]']").val(cliente.endereco.cen_bairro);
                $("input[name='cliente[cidade]']").val(cliente.endereco.cen_cidade);
                $("input[name='cliente[estado]']").val(cliente.endereco.cen_estado);

            }else{

                $("#msgUsuario").html(msgDanger("Empresa não cadastrada."));
            }

        });
    }
});

function validaAbaPedido()
{
    let pedidoPreencido = true;

    $("#pedido input,select").each(function(){

        if($(this).attr('required') == 'required'){

            if( $.trim($(this).val()) == "" ){

                pedidoPreencido = false;
            }

        }
    });

    if(pedidoPreencido == false){

        $("#cliente-tab").addClass('disabled');
        $("#produto-tab").addClass('disabled');

    }else{

        $("#cliente-tab").removeClass('disabled');
        alert('Falta pouco, acesse a aba de clientes antes de salvar!');

    }
}

function validaAbaCliente()
{
    let clientePreencido = true;

    $("#cliente input").each(function(){

        if($(this).attr('required') == 'required'){

            if( $.trim($(this).val()) == "" ){

                clientePreencido = false;
            }
        }
    });

    if(clientePreencido == false){

        $("#produto-tab").addClass('disabled');

    }else{

        $("#produto-tab").removeClass('disabled');
        alert('Acesse a aba de produtos, antes de salvar!');

    }
}

function validaAbaPedidoGeral()
{console.log('aaaa');
    validaAbaPedido();
    //validaAbaCliente();
}

function validaAbaClienteGeral()
{
    validaAbaCliente();
    //validaAbaCliente();
}


$(document).ready(function() {
    $('.js-example-basic-single').select2();
});