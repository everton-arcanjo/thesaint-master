@extends('principal')
@section('conteudo')

<a href="/materiaprima/create" class="btn btn-outline btn-primary">Cadastrar</a>

<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;" width="100%">
        <thead>
            <tr role="row">
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 200px;" aria-label="Browser: activate to sort column ascending">Codigo Estampa</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 181px;" aria-label="Platform(s): activate to sort column ascending">Molde</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 154px;" aria-label="Engine version: activate to sort column ascending">Tipo</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">Qtd.Peças</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">Processo Atual</th>
                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 112px;" aria-label="CSS grade: activate to sort column ascending">Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr class="gradeA odd" role="row">
                    <td>5689</td>
                    <td>1212</td>
                    <td >T-Shirt Manga Curta</td>
                    <td>50</td>
                    <td>P1 - Matéria Prima</td>
                    <td>
                        <a href="/linhatempo/edit/1" class="btn btn-success">
                            Editar
                        </a>
                        <a href="#" class="btn btn-danger">
                            Excluir
                        </a>
                    </td>
            </tr>
        </tbody>
    </table
@endsection

