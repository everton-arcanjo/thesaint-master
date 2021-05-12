<tr>
        <td>

            <select class="form-control" name="produto[tecido][]" required="required"  onchange="alterarLinha(this)" style="width: 200px" required="required">
                <option value="">Selecione</option>
                @foreach ($listaTecido as $tecido)
                    <option value="{{$tecido->tec_id}}">{{$tecido->tec_tecido}}</option>
                @endforeach
            <select>

            </td>
        <td>

            <select class="form-control" name="produto[cor][]" required="required" style="width: 200px" required="required">
                <option value="">Selecione</option>
                @foreach ($listaCor as $cor)
                    <option value="{{$cor->cor_id}}">{{$cor->cor_cor}}</option>
                @endforeach
            <select>

        </td>
        <td>

            <select class="form-control" name="produto[fornecedor][]" required="required" style="width: 250px" required="required">
                <option value="">Selecione</option>
                @foreach ($listaFornecedor as $fornecedor)
                    <option value="{{$fornecedor->for_id}}">{{$fornecedor->for_razao_social}}</option>
                @endforeach
            <select>

        </td>

        <td>
            <input type="text" class="form-control" input="quantidade" required="required" name="produto[quantidade][]" placeholder="Quantidade" required="required">
        </td>

        <td>
            <input type="text" readonly="readonly" class="form-control" required="required" name="produto[unidade][]" placeholder="Unidade" required="required">
        </td>

        <td>
            <a href="#" onclick="removerLinha(this)">Excluir</a>
        </td>
    </tr>
