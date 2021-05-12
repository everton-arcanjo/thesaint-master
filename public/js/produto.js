$(document).ready(function(){
    $("input[name='detalhe[valor][]']").mask('000.000.000.000.000,00', {reverse: true});
})


$("#adicionarCaracterisca").click(function(){

    $.ajax({
        type: 'GET',
        url: '/produto/adicionarlinhacaracteristicas',
        dataType: 'html',
        success: function( response ){

            $("#tabelaProdutoCaracteristica tbody").append( response );
            $("input[name='detalhe[valor][]']").mask('000.000.000.000.000,00', {reverse: true});

        },
        error: function(){

        }
    });

});

function removeLinha(idLinha)
{
    $("#linhaTabela"+idLinha).remove();
}


function verificaProdutoDuplicidade(codigo)
{
    let linha = $("#tabelaProdutoCaracteristica>tbody>tr");
    let codigoProduto = null;
    let contador = null;
    let ultimaChave = null;
    if( linha.length > 0 ){

         linha.each(function(chave,elemento){
            codigoProduto = $.trim(elemento.cells[0].children[0].value);
            if(codigoProduto == codigo){
                contador++;
                ultimaChave = chave;
            }

        });

        if(contador > 1){
            linha[ultimaChave].remove();
            $("#msgUsuario").html(msgDanger("Produto não cadastrado"));
        }
     }
}

function buscaDadosMolde(objParam)
{
    let idMolde = $(objParam).val();
    let obj = $(objParam);

    if(idMolde != ""){

        $.getJSON('/api/molde/showjson/'+idMolde, function( resposta ){
            linha = obj.closest("tr");
            linha[0].cells[2].children[0].value = resposta.mol_consumo;
            linha[0].cells[3].children[0].value = exibeUnidade(resposta.mol_unidade);

        });
    }
}
