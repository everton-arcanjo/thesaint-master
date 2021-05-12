@extends('principal')
@section('conteudo')

<a href="/tipoproduto/create" class="btn btn-outline btn-primary">Cadastrar</a>

<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;" width="100%">
        <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 178px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">Código</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 200px;" aria-label="Browser: activate to sort column ascending">Tipo Produto</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if( count($listaTipoProduto) )
                @foreach ($listaTipoProduto as $chave => $tipoProduto)
                    <tr @if($chave%2 == 0) class="gradeA odd" @else class="gradeA even" @endif role="row">
                        <td>{{ $tipoProduto->tpr_codigo }}</td>
                        <td>{{ $tipoProduto->tpr_tipo_produto }}</td>
                        <td>
                            <a href="/tipoproduto/edit/{{ $tipoProduto->tpr_id }}" class="btn btn-success">
                                Editar
                            </a>
                            <a href="/tipoproduto/destroy/{{ $tipoProduto->tpr_id }}" class="btn btn-danger">
                                Excluir
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table
@endsection

