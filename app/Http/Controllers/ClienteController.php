<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Cliente;
use App\ClienteContato;
use App\ClienteEndereco;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:administrador_vendedor_producao');
    }

    public function index()
    {
        $filtro = \Request::input('filtro');

        if(is_null($filtro)){

            $filtro = [];

            if(Auth::user()->cli_dep_id == 4){

                $listaCliente = Cliente::where('cli_usu_id','=',Auth::user()->usu_id)->paginate(10);

            }else{

                $listaCliente = Cliente::paginate(10);

            }

        }else{

            $listaCliente = Cliente::where('cli_cnpj','LIKE','%'.$filtro['cnpj'].'%');

            if(Auth::user()->cli_dep_id == 4){

                $listaCliente->where('cli_usu_id', '=',Auth::user()->usu_id);

            }

            if(isset($filtro['razao_social']) && !empty($filtro['razao_social'])){

                $listaCliente->where('cli_razao_social', 'LIKE','%'.$filtro['razao_social'].'%');
            }

            if(isset($filtro['nome_contato']) && !empty($filtro['nome_contato'])){

                $nomeContato = $filtro['nome_contato'];

                $listaCliente->whereHas('contato',function($query) use ($nomeContato){
                    $query->where('cco_nome_contato', 'LIKE','%'.$nomeContato.'%');
                });
            }

            if(isset($filtro['telefone']) && !empty($filtro['telefone'])){

                $telefone = $filtro['telefone'];

                $listaCliente->whereHas('contato',function($query) use ($telefone){
                    $query->where('cco_telefone_comercial', 'LIKE','%'.$telefone.'%');
                });
            }

            if(isset($filtro['celular']) && !empty($filtro['celular'])){

                $celular = $filtro['celular'];

                $listaCliente->whereHas('contato',function($query) use ($celular){
                    $query->where('cco_celular', 'LIKE','%'.$celular.'%');
                });
            }


            $listaCliente = $listaCliente->paginate(10);
        }

        return view('cliente.index',compact('listaCliente'));
    }


    public function create()
    {
        return view('cliente.novo');
    }


    public function store(Request $request)
    {
        $cliente = $request->input('cliente');

        \Validator::make(['cli_cnpj' => $cliente['cnpj']], [
            'cli_cnpj' => '|unique:cliente,cli_cnpj',
        ],['unique' => 'CNPJ já cadastrado.'])->validate();


        $objCliente = new Cliente();
        $objCliente->cli_cnpj = $cliente['cnpj'];
        $objCliente->cli_razao_social = $cliente['razao_social'];
        $objCliente->cli_nome_fantasia = $cliente['nome_fantasia'];
        $objCliente->cli_inscricao_estadual = $cliente['inscricao_estadual'];
        $objCliente->cli_usu_id = Auth::user()->usu_id;
        $objCliente->save();

        $objClienteContato = new ClienteContato();
        $objClienteContato->cco_nome_contato = $cliente['contato'];
        $objClienteContato->cco_telefone_comercial = $cliente['telefone'];
        $objClienteContato->cco_celular = $cliente['celular'];
        $objClienteContato->cco_email = $cliente['email'];
        $objCliente->contato()->save($objClienteContato);

        $objClienteEndereco = new ClienteEndereco();
        $objClienteEndereco->cen_cep = $cliente['cep'];
        $objClienteEndereco->cen_endereco = $cliente['endereco'];
        $objClienteEndereco->cen_numero = $cliente['numero'];
        $objClienteEndereco->cen_complemento = $cliente['complemento'];
        $objClienteEndereco->cen_bairro = $cliente['bairro'];
        $objClienteEndereco->cen_cidade = $cliente['cidade'];
        $objClienteEndereco->cen_estado = $cliente['estado'];
        $objCliente->endereco()->save($objClienteEndereco);

        return redirect('\cliente');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $objCliente = Cliente::findOrFail($id);


        if (Gate::forUser(Auth::user())->denies('permite_cliente', $objCliente)) {

            return redirect('/cliente');
        }

        return view('cliente.editar',compact('objCliente'));
    }


    public function update(Request $request, $id)
    {
        $cliente = $request->input('cliente');

        \Validator::make(['cli_cnpj' => $cliente['cnpj']],[
            'cli_cnpj' =>[
                Rule::unique('cliente')->where('cli_usu_id',Auth::user()->usu_id)->whereNull('deleted_at')->ignore($id,'cli_id')],
            ],
            ['unique' => 'CNPJ já cadastrado.']
        )->validate();

        \DB::beginTransaction();
        try{

            //$objCliente = new Cliente();
            Cliente::atualiza($cliente, $id);

            \DB::commit();

        }catch(\Exception $e){
           \DB::rollback();
        }


        return redirect('\cliente');

    }


    public function destroy($id)
    {
        $objCliente = Cliente::find($id);
        $objCliente->delete();

        return redirect('cliente');
    }

}
