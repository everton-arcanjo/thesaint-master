<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

use App\Fornecedor;
use App\FornecedorEndereco;

class FornecedorController extends Controller
{

    public function index()
    {

        $filtro = \Request::input('filtro');

        if(is_null($filtro)){

            $filtro = [];
            $listaFornecedor = Fornecedor::paginate(10);

        }else{

                $listaFornecedor = Fornecedor::where('for_razao_social','LIKE','%'.$filtro['razao_social'].'%');

                if( !is_null($filtro['cnpj']) || !empty($filtro['cnpj']) ){

                    $listaFornecedor->where('for_cnpj','=',$filtro['cnpj']);
                }

                if( !is_null($filtro['email']) || !empty($filtro['email']) ){

                    $listaFornecedor->where('for_email','like',"%".$filtro['email']."%");
                }

                if( !is_null($filtro['telefone']) || !empty($filtro['telefone']) ){

                    $listaFornecedor->where('for_telefone','=',$filtro['telefone']);
                }

                $listaFornecedor = $listaFornecedor->paginate(10);
        }

        return view('fornecedor.index',compact('listaFornecedor','filtro'));
    }


    public function create()
    {
        return view('fornecedor.novo');
    }

    public function store(Request $request)
    {
        $objFornecedor = new Fornecedor();
        $dadosFornecedor = $request->input('fornecedor');

        \Validator::make(
            ['for_cnpj' => str_replace(['.','/','-'],"",$dadosFornecedor['cnpj'])],
            ['for_cnpj' =>[
                Rule::unique('fornecedor','for_cnpj')->whereNull('deleted_at')],
            ],
            ['unique' => 'CNPJ já cadastrado.']
        )->validate();

        $objFornecedor->for_razao_social = $dadosFornecedor['razao_social'];
        $objFornecedor->for_nome_fantasia = $dadosFornecedor['nome_fantasia'];
        $objFornecedor->for_cnpj = str_replace(['.','/','-'],"",$dadosFornecedor['cnpj']);
        $objFornecedor->for_contato = $dadosFornecedor['contato'];
        $objFornecedor->for_email = $dadosFornecedor['email'];
        $objFornecedor->for_telefone = $dadosFornecedor['telefone'];
        $objFornecedor->for_celular = $dadosFornecedor['celular'];

        $objFornecedor->save();

        $objFornecedorEndereco = new FornecedorEndereco();
        $objFornecedorEndereco->fen_cep = $dadosFornecedor['cep'];
        $objFornecedorEndereco->fen_endereco = $dadosFornecedor['endereco'];
        $objFornecedorEndereco->fen_numero = $dadosFornecedor['numero'];
        $objFornecedorEndereco->fen_complemento = $dadosFornecedor['complemento'];
        $objFornecedorEndereco->fen_bairro = $dadosFornecedor['bairro'];
        $objFornecedorEndereco->fen_cidade = $dadosFornecedor['cidade'];
        $objFornecedorEndereco->fen_estado = $dadosFornecedor['estado'];

        $objFornecedor->endereco()->save($objFornecedorEndereco);

        return redirect('/fornecedor');

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $objFornecedor = Fornecedor::findOrFail($id);
        if( is_object($objFornecedor) ){

            return view('fornecedor.editar',compact('objFornecedor'));
        }

        return redirect('/fornecedor');

    }

    public function update(Request $request, $id)
    {
        $objFornecedor = Fornecedor::findOrFail($id);
        $dadosFornecedor = $request->input('fornecedor');

        \Validator::make(
            ['for_cnpj' => str_replace(['.','/','-'],"",$dadosFornecedor['cnpj'])],
            ['for_cnpj' =>[
                Rule::unique('fornecedor','for_cnpj')->whereNull('deleted_at')->ignore($id,'for_id')],
            ],
            ['unique' => 'CNPJ já cadastrado.']
        )->validate();

        if( is_object($objFornecedor) ){

            $objFornecedorEndereco = $objFornecedor->endereco;

            if( !is_object($objFornecedorEndereco) ){

                $objFornecedorEndereco = new FornecedorEndereco();
            }

            $objFornecedor->for_razao_social = $dadosFornecedor['razao_social'];
            $objFornecedor->for_nome_fantasia = $dadosFornecedor['nome_fantasia'];
            $objFornecedor->for_cnpj = str_replace(['.','/','-'],"",$dadosFornecedor['cnpj']);
            $objFornecedor->for_contato = $dadosFornecedor['contato'];
            $objFornecedor->for_email = $dadosFornecedor['email'];
            $objFornecedor->for_telefone = $dadosFornecedor['telefone'];
            $objFornecedor->for_celular = $dadosFornecedor['celular'];
            $objFornecedor->save();

            $objFornecedorEndereco->fen_cep = $dadosFornecedor['cep'];
            $objFornecedorEndereco->fen_endereco = $dadosFornecedor['endereco'];
            $objFornecedorEndereco->fen_numero = $dadosFornecedor['numero'];
            $objFornecedorEndereco->fen_complemento = $dadosFornecedor['complemento'];
            $objFornecedorEndereco->fen_bairro = $dadosFornecedor['bairro'];
            $objFornecedorEndereco->fen_cidade = $dadosFornecedor['cidade'];
            $objFornecedorEndereco->fen_estado = $dadosFornecedor['estado'];
            $objFornecedor->endereco()->save($objFornecedorEndereco);



        }

        return redirect('/fornecedor');
    }

    public function destroy($id)
    {
        $objFornecedor = Fornecedor::findOrFail($id);
        if( is_object($objFornecedor) ){

            $objFornecedor->delete();
        }

        return redirect('/fornecedor');
    }
}
