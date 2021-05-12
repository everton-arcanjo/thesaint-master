<tr>

    <td style='width: 130px'>
        <input type='text' class='form-control' onchange="verificaProdutoDuplicidade(this.value)" name='detalhe[codigo][]' value="">
    </td>

    <td style='width: 130px'>
        <select class='form-control' name='detalhe[molde][]' onchange="buscaDadosMolde(this)">
            <option value="">Selecione</option>
            @foreach ($listaMolde as $molde)
                <option value="{{ $molde->mol_id }}"> {{ $molde->mol_molde }} </option>
            @endforeach
        </select>
    </td>

    <td style="width: 130px">
        <input readonly="readonly" type="text" class="form-control" value="">
    </td>

    <td style="width: 130px">
        <input readonly="readonly" type="text" class="form-control" value="">
    </td>

    <td style='width: 130px'>
        <select class='form-control' name='detalhe[cor][]'>
            <option class='form-control' value="">Selecione</option>
            @foreach ($listaCor as $cor)
                <option value="{{ $cor->cor_id }}"> {{ $cor->cor_cor }} </option>
            @endforeach
        </select>
    </td>

    <td style='width: 130px'>
            <select class='form-control' name='detalhe[tecido][]'>
                <option value="">Selecione</option>
                @foreach ($listaTecido as $tecido)
                    <option value="{{ $tecido->tec_id }}"> {{ $tecido->tec_tecido }} </option>
                @endforeach
            </select>
    </td>

    <td style='width: 130px'>
        <input type='text' class='form-control' name='detalhe[valor][]' value=''>
    </td>

    <td style='width: 130px'>
        <button type='button' class='btn btn-outline-danger btn-sm' onclick="removerLinha( this )">Excluir</button>
    </td>
</tr>
