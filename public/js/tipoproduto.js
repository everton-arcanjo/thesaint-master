$(document).ready(function(){
    //$("#adicionarCaracterisca").click();
})


$("#adicionarTipoProdutoModelo").click(function(){

    let linha = "";

    linha="<tr>";
        linha+="<td style='width: 130px'><input class='form-control' type='text'  name='tipoProdutoModelo[modelo][]' value=''></td>";
        linha+="<td style='width: 130px'><input class='form-control' type='text'  name='tipoProdutoModelo[consumo][]' value=''></td>";
        linha+="<td style='width: 130px'><select class='form-control' name='tipoProdutoModelo[medida][]' ><option value=''>Selecione</option><option value='GR'>g</option><option value='KG'>kg</option></select></td>";
        linha+="<td style='width: 130px'><button type='button' class='btn btn-outline-danger btn-sm'>Excluir</button></td>";
    linha+="</tr>";

    $("#tabelaTipoProdutoMolde tbody").append(linha);

});

function removeLinha(idLinha)
{
    $("#linhaTabela"+idLinha).remove();
}
