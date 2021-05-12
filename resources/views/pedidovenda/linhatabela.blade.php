<tr role="row">
    <td style="padding: 0px">
        <input type="text" required="required" onchange="buscaInfoProduto( this )" style="width: 80px;" name="produto[codigo][]" placeholder="Codigo">
        <input type="hidden" name="produto[pca_id][]" value="">
    </td>
    <td style="padding: 0px">
        <input type="text" required="required" readonly="readonly" style="width: 100px;" name="produto[tipo][]" placeholder="Tipo">
    </td>
    <td style="padding: 0px">
        <input type="text" required="required" readonly="readonly" style="width: 100px;" name="produto[molde][]" placeholder="Molde">
    </td>
    <td style="padding: 0px">
        <input type="text" required="required" readonly="readonly" style="width: 100px;" name="produto[cor][]" placeholder="Cor">
    </td>
    <td style="padding: 0px">
        <input type="text" required="required" readonly="readonly" style="width: 130px;" name="produto[tecido][]" placeholder="Tecido">
    </td>
    <td style="padding: 0px">
        <input required="required" onchange="somaPeca( this )" readonly="readonly" min="0" max="999" type="number" style="width: 45px;" name="produto[tamanho_pp][]" placeholder="PP" value="0">
    </td>
    <td style="padding: 0px">
        <input required="required" onchange="somaPeca( this )" readonly="readonly" min="0" max="999" type="number" style="width: 45px;" name="produto[tamanho_p][]" placeholder="P" value="0">
    </td>
    <td style="padding: 0px">
        <input required="required" onchange="somaPeca( this )" readonly="readonly" min="0" max="999" type="number" style="width: 45px;" name="produto[tamanho_m][]" placeholder="M" value="0">
    </td>
    <td style="padding: 0px">
        <input required="required" onchange="somaPeca( this )"readonly="readonly"  min="0" max="999" type="number" style="width: 45px;" name="produto[tamanho_g][]" placeholder="G" value="0">
    </td>
    <td style="padding: 0px">
        <input required="required" onchange="somaPeca( this )" readonly="readonly" min="0" max="999" type="number" style="width: 45px;" name="produto[tamanho_gg][]" placeholder="GG" value="0">
    </td>
    <td style="padding: 0px;">
        <input required="required" type="number" readonly="readonly" style="width: 50px;" name="produto[qtd_total][]" placeholder="Qtd.Total">
    </td>
    <td style="padding: 0px">
        <input required="required" type="text" style="width: 100px;" name="produto[valor_unitario][]" placeholder="Valor Unit">
    </td>
    <td style="padding: 0px">
        <input required="required" type="text" readonly="readonly" style="width: 100px;" name="produto[valor_total][]" placeholder="Total">
    </td>
    <td style="padding: 0px;">
        <button onclick="removerLinhaPedido( this )" class="btn btn-danger btn-sm">Excluir</button>
    </td>
</tr>
