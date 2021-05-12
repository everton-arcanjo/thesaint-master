@extends('principal')
@section('conteudo')

<form role="form" name="formProdutoFinal" action="#" method="post">
    @csrf

    <div class="form-group">
        <label>Tipo</label>
        <input class="form-control"  placeholder="Tipo" name="produto[tipo]" value="T-Shirt Manga Curta">
    </div>

    <div class="row">
    </div>
    <a href="#" class="btn btn-outline btn-primary" style="margin-bottom: 5px">Adicionar</a>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Materia Prima (P1)</th>
                <th scope="col">Corte (P2)</th>
                <th scope="col">Estamparia (P3)</th>
                <th scope="col">Costura (P4)</th>
                <th scope="col">Revisão (P5)</th>
                <th scope="col">Despacho (P6)</th>
            </tr>
        </thead>
            <tbody>
              <tr>
                <td>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Data Inicio</th>
                                <th scope="col">Compra</th>
                                <th scope="col">Rec Matéria</th>
                                <th scope="col">Data Fim</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">20/11/2018</th>
                                <td>Feito</td>
                                <td>Aguardando</td>
                                <td>22/11/2018</td>
                            </tr>
                        </tbody>
                    </table>
                </td>

                <td>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Data Inicio</th>
                                    <th scope="col">Descanso</th>
                                    <th scope="col">Corte/Encaixe</th>
                                    <th scope="col">Data Fim</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">20/11/2018</th>
                                    <td>Feito</td>
                                    <td>Aguardando</td>
                                    <td>22/11/2018</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>


              </tr>
               </tbody>
        </table>

    <br>
    <button type="reset" class="btn btn-default">Salvar</button>
    <button type="reset" class="btn btn-default">Voltar</button>

</form>

@detalheproduto()@enddetalheproduto

@endsection
