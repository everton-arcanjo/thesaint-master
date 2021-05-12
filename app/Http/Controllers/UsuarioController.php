<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Departamento;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:administrador');
    }

    public function index()
    {
        $filtro = \Request::input('filtro');
        $listaDepartamento = Departamento::all();

        if(is_null($filtro)){

            $filtro = [];
            $listaUsuario = Usuario::paginate(10);

        }else{

            $listaUsuario = Usuario::where('usu_nome','LIKE','%'.$filtro['nome'].'%');

            if(isset($filtro['email']) && !empty($filtro['email'])){

                $listaUsuario->where('usu_email', 'LIKE','%'.$filtro['email'].'%');
            }

            if(isset($filtro['login']) && !empty($filtro['login'])){

                $listaUsuario->where('usu_login', 'LIKE','%'.$filtro['login'].'%');

            }


            if(isset($filtro['telefone']) && !empty($filtro['telefone'])){

               $listaUsuario->where('usu_telefone', 'LIKE','%'.$filtro['telefone'].'%');

            }

            if(isset($filtro['departamento']) && !empty($filtro['departamento'])){

                $listaUsuario->where('usu_dep_id', '=',$filtro['departamento']);

             }

            $listaUsuario = $listaUsuario->paginate(10);
        }

        return view('usuario.index',compact('listaUsuario','listaDepartamento'));
    }


    public function create()
    {
        $listaDepartamento = Departamento::all();
        return view('usuario.novo',compact('listaDepartamento'));
    }


    public function store(Request $request)
    {
        $usuario = $request->input('usuario');
        $usuario['senha'] = trim($usuario['senha']);

        \Validator::make(
            [
                'usu_email' => $usuario['email'],
                'usu_login' => $usuario['login']
            ],
            [
                'usu_email' =>[Rule::unique('usuario')->whereNull('deleted_at')],
                'usu_login' =>[Rule::unique('usuario')->whereNull('deleted_at')]
            ],
            [
                'unique' => ':attribute já cadastrado.'
            ])->validate();

        $objUsuario = new Usuario();

        $objUsuario->usu_nome = $usuario['nome'];
        $objUsuario->usu_telefone = $usuario['telefone'];
        $objUsuario->usu_celular = $usuario['celular'];
        $objUsuario->usu_email = $usuario['email'];
        $objUsuario->usu_login = $usuario['login'];
        $objUsuario->usu_senha = Hash::make($usuario['senha']);
        $objUsuario->usu_dep_id = $usuario['departamento'];
        $objUsuario->save();

        return redirect('/usuario');


    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $objUsuario = Usuario::find($id);
        $listaDepartamento = Departamento::all();
        return view('usuario.editar',compact('listaDepartamento','objUsuario'));

    }


    public function update(Request $request, $id)
    {

        $objUsuario = Usuario::findOrFail($id);
        $usuario = $request->input('usuario');
        $usuario['senha'] = trim($usuario['senha']);

        \Validator::make(
            [
                'usu_email' => $usuario['email'],
                'usu_login' => $usuario['login']
            ],
            [
                'usu_email' =>[Rule::unique('usuario')->whereNull('deleted_at')->ignore($id,'usu_id')],
                'usu_login' =>[Rule::unique('usuario')->whereNull('deleted_at')->ignore($id,'usu_id')]
            ],
            [
                'unique' => ':attribute já cadastrado.'
            ])->validate();

        $objUsuario->usu_nome = $usuario['nome'];
        $objUsuario->usu_telefone = $usuario['telefone'];
        $objUsuario->usu_celular = $usuario['celular'];
        $objUsuario->usu_email = $usuario['email'];
        $objUsuario->usu_login = $usuario['login'];
        $objUsuario->usu_dep_id = $usuario['departamento'];

        if( !empty($usuario['senha']) ){

            $objUsuario->usu_senha = Hash::make($usuario['senha']);

        }

        $objUsuario->save();

        return redirect('/usuario');
    }


    public function destroy($id)
    {
        $objUsuario = Usuario::findOrFail($id);
        $objUsuario->delete();

        return redirect('/usuario');
    }
}
