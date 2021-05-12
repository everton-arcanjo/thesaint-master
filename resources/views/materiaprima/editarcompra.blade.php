@extends('principal')
@section('conteudo')
@compram(['listaFornecedor' => $listaFornecedor])@endcompram


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcompra">
    Nova Compra
 </button>
<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;" width="100%">
        <thead>
            <tr role="row">
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 80px;" aria-label="Browser: activate to sort column ascending">Data</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 181px;" aria-label="Platform(s): activate to sort column ascending">Fornecedor</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 80px;" aria-label="Engine version: activate to sort column ascending">Prazo</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 80px;" aria-label="Engine version: activate to sort column ascending">Prev. Recebimento</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 80px;" aria-label="Engine version: activate to sort column ascending">Qtd (KG)</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 80px;" aria-label="Engine version: activate to sort column ascending">Tipo</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if( count($listaMateriaPrimaCompra) > 0 )
                @foreach ($listaMateriaPrimaCompra as $materiaPrimaCompra)
                    <tr>
                        <td>{{ date("d/m/Y",strtotime($materiaPrimaCompra->mtc_data)) }}</td>
                        <td>{{ $materiaPrimaCompra->mtc_for_id }}</td>
                        <td>{{ $materiaPrimaCompra->prazo }}</td>
                        <td>{{ date('d/m/Y',strtotime($materiaPrimaCompra->mtc_data_previsao)) }}</td>
                        <td>{{ $materiaPrimaCompra->mtc_quantidade }}</td>
                        <td> @if( $materiaPrimaCompra->mtc_movimento == 'E' ) Entrada @else Saida  @endif </td>
                        <td>
                            <a href="/materiaprima/editarcompra/{{ $materiaPrimaCompra->mtc_mpr_id }}" class="btn btn-primary btn-sm">Editar</a>
                            <a href="/materiaprima/excluircompra/{{ $materiaPrimaCompra->mtc_mpr_id }}" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach

            @endif
        </tbody>
    </table
@endsection

