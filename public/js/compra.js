$(document).ready(function(){

    $('#prazo').mask('999');
    $('#quantidade').mask('999.99');

});


$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

$("#salvarCompra").click(function(){

    let idMateriaPrimaCompra = $("#idMateriaPrimaCompra").val();
    let numeroPedidoMateriaPrima = $("#numeroPedidoMateriaPrima").val();
    let codMateriaPrima = $("#codMateriaPrima").val();
    let idMateriaPrima = $("#idMateriaPrima").val();
    let dataEstoque = $("#dataEstoque").val();
    let fornecedor = $("#fornecedor").val();
    let prazo = $("#prazo").val();
    let previsaoRecebimento = $("#previsaoRecebimento").val();
    let quantidade = $("#quantidade").val();
    let entradaSaida = $("#entradaSaida").val();

    let objCompra = {
        'idMateriaPrimaCompra': idMateriaPrimaCompra,
        'numeroPedidoMateriaPrima': numeroPedidoMateriaPrima,
        'codMateriaPrima': codMateriaPrima,
        'idMateriaPrima': idMateriaPrima,
        'dataEstoque': dataEstoque,
        'fornecedor': fornecedor,
        'prazo':prazo,
        'previsaoRecebimento': previsaoRecebimento,
        'quantidade': quantidade,
        'entradaSaida': entradaSaida}

    $.post('api/materiaprima/lancar',objCompra,function( response ){

        if( response ){

            window.location = "/compra";
        }

    });

});



$("#prazo").change(function(){

    let qtdDia = $( this ).val();

    var novaData = new Date().addDays(qtdDia);
    let dia = novaData.getDate();

    if(dia >= 1 && dia <= 9){
        dia = "0"+dia;
    }

    let mes = novaData.getMonth()+1;

    if(mes >= 1 && mes <= 9){
        mes = "0"+mes;
    }

    let ano = novaData.getFullYear();
    let dataFormatada = ano+"-"+mes+"-"+dia;

    $("#previsaoRecebimento").val(dataFormatada);

    let data = $.trim($("#previsaoRecebimento").val());

    while(data == ""){

        qtdDia++;
        dataAtual = new Date();
        novaData = dataAtual.addDays(qtdDia);
        dia = novaData.getDate();
        mes = novaData.getMonth();
        ano = novaData.getFullYear();

        if(dia >= 1 && dia <= 9){
            dia = "0"+dia;
        }

        if(mes >= 1 && mes <= 9){
            mes = "0"+mes;
        }

        dataFormatada = ano+"-"+mes+"-"+dia;
        $("#previsaoRecebimento").val(dataFormatada);

        data = $.trim($("#previsaoRecebimento").val())
    }


});

Date.prototype.addDays = function(days) {
    this.setDate(this.getDate() + parseInt(days));
    return this;
  };

function editarMateriaPrimaCompra(compra)
{
    $.getJSON('api/materiaprima/showmateriaprimacompra/'+compra, function( response ){

        $("#modalcompra").modal('show');
        //alert(response.mtc_numero_pedido);
        $("#idMateriaPrimaCompra").val(response.mtc_id);
        $("#numeroPedidoMateriaPrima").val(response.mtc_numero_pedido);
        $("#idMateriaPrima").val(response.materiaprima.mpr_id);
        $("#codMateriaPrima").val(response.materiaprima.mpr_codigo);
        $("#nomeMateriaPrima").val(response.materiaprima.mpr_nome);
        $("#dataEstoque").val(response.mtc_data);
        $("#fornecedor").val(response.fornecedor.for_id);
        //$("#corMateriaPrima").val(response.materiaprimacompra.materiaprima.mpr_id);
        $("#prazo").val(response.prazo);
        $("#previsaoRecebimento").val(response.mtc_data_previsao);
        $("#quantidade").val(response.mtc_quantidade);

        $.getJSON('api/materiaprima/show/'+ response.materiaprima.mpr_codigo, function( response ){
            if( response.erro ){
                $("#msgUsuario").html(msgDanger("Matéria Prima não localizada"));
            }else{
                $("#corMateriaPrima").val(response.cor.cor_cor);
            }

        })



    });

}

function novoProduto()
{

    $.ajax({
        url: "/compra/adicionarLinha",
        method: "GET",
        dataType: "html",
        success: function(response){
            $("#tabelaMaisProduto>tbody").append(response)
        }

    })
}

function alterarLinha(obj)
{

    if(obj.value != ""){

        $.getJSON('/tecido/show/'+obj.value,function(response){

        if( response != undefined ){
            let linha =  $(obj).closest('tr')
            linha[0].cells[4].children[0].value = response.tec_unidade;
          }

        })
    }

}
