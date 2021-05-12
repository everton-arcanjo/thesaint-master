
$("#adicionarEstoque").click(function(){

    var inputs = $('#modalestoque :input');
    var erro = false;

    inputs.each(function() {
        if($(this).prop('required')){

            var valor = $.trim($(this).val());

            if(valor == ""){

                erro = true;
                $("#msg").removeAttr('hidden');
                $(this).addClass("border border-danger");

            }else{

                $(this).removeClass("border border-danger");

            }
        }
    });

    if(erro == false){

    }

});

function voltar(caminho)
{
    window.location.href = caminho;
}

function msgDanger(mensagem)
{
    $alerta = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
    $alerta+=mensagem;
    $alerta+="<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
    $alerta+="<span aria-hidden='true'>&times;</span>";
    $alerta+="</button>";
    $alerta+="</div>";

    return $alerta;

}

Date.prototype.addDays = function(qtdDia) {
    this.setDate(this.getDate() + parseInt(qtdDia));
    return this;
};

function voltar(rota)
{
    window.location.href = rota;

}

function removerLinha( obj )
{
    var row_index = $(obj).closest("tr").remove();

}

$("#selecaoPrincipal").click(function(evento){
    let ativo = evento.target.checked;

    if(ativo === true){
        $("input[name^='pedidoSelecao[']").attr('checked','checked');
    }else{

        $("input[name^='pedidoSelecao[']").removeAttr('checked');
    }

    $("input[name^='pedidoSelecao[']").each(function(index,valor){

        if(valor.checked == true){
            $("#acaoAprovar").css('display','flex');
        }else{
            $("#acaoAprovar").css('display','none');
        }
    });

});

function aprovarRecusar(decisao)
{
    let pedido = [];
    $("input[name^='pedidoSelecao[']").each(function(index,valor){

        if(valor.checked == true){

            objPedido = {id:valor.value, decisao:decisao};
            pedido.push(objPedido);

        }
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: '/pedidovenda/aprovarecusa',
        data: {pedido:pedido},
        dataType: 'json',
        success: function( response ){

            if( response.msg == 'sucesso' ){
                location.reload();
            }

            if( response.msg == 'erro' ){
                alert(response.msg_erro);
            }

        },
        error: function(){

        }
    });

    /*
    $.post('pedidovenda/aprovarecusa',{'pedido':pedido}, function(response){
        console.log(response);
    });*/
}

function selecaoUnica(event)
{
    let registroChecado = "N";
    let ativo = event.target.checked;

    if(ativo == true || ativo == false){

        $("input[name^='pedidoSelecao[']").each(function(index,valor){

            if(valor.checked == true){
                registroChecado = "S";

            }
        });

    }

    if(registroChecado == "S"){

        $("#acaoAprovar").css('display','flex');

    }else{

        $("#acaoAprovar").css('display','none');

    }

}

function exibeUnidade(unidade)
{
    switch(unidade)
    {
        case 'MT': return 'Metro'; break;
        case 'GR': return 'Grama'; break;
        case 'KG': return 'Kilo'; break;
    }
}
