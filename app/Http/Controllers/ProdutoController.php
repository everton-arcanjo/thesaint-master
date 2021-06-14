<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\ProdutoCaracteristica;
use App\Molde;
use App\Cor;
use App\Tecido;

use Illuminate\Validation\Rule;
use illuminate\Validation\Validator;

class ProdutoController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $this->middleware('auth');

        $produto = \Request::input('produto');
        $filtro = [];
        if( empty($produto) || is_null($produto) ){

            $listaProduto = Produto::paginate(10);
            $filtro['produto'] = $produto;

        }else{

            $listaProduto = Produto::where('pro_tipo','LIKE','%'.$produto.'%')
                ->paginate(10);
        }
        return view('produto.index',compact('listaProduto','filtro'));
    }

    public function create()
    {
        $produto = \Request::input('produto');
        $this->middleware('auth');

        $listaMolde = Molde::all();
        $listaCor = Cor::all();
        $listaTecido = Tecido::all();


        if( empty($produto) || is_null($produto) ){

            $listaProduto = Produto::paginate(10);

        }else{

            $listaProduto = Produto::where('pro_tipo','LIKE','%'.$produto.'%')
                ->paginate(10);
        }        
        return view('produto.novo',compact('listaProduto','listaMolde','listaCor','listaTecido'));
    }

    public function store(Request $request)
    {
        $this->middleware('auth');
        $request->validate([
                'tipo' => 'unique:produto,pro_tipo'
            ],
            [
                'unique' => 'Produto ja cadastrado.'
            ]
        );

        Produto::salvarProdutoFinal($request);
        return redirect('produto');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function edit($id)
    {
        $this->middleware('auth');
        $produto = Produto::findOrFail($id);



        $listaMolde = Molde::all();
        $listaCor = Cor::all();
        $listaTecido = Tecido::all();
        $caracteristicas = ProdutoCaracteristica::where('pca_pro_id','=',$id)->get();


        if( is_object($produto) ){

            return view('produto.editar',compact('produto','listaMolde','listaCor','listaTecido','caracteristicas'));
        }

        return redirect('/produto');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->middleware('auth');
        \Validator::make([
            'pro_tipo' => $request->input('tipo')
        ],
        [
            'pro_tipo' => Rule::unique('produto')->whereNull('deleted_at')->ignore($id,'pro_id')
        ],
        ['unique' => 'Produto já cadastrado'])
        ->validate();

        Produto::salvarProdutoFinal($request,$id);
        return redirect('/produto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('auth');
        $objProduto = Produto::find($id);
        if( is_object($objProduto) ){

            $objProduto->delete();
        }
        return redirect('/produto');

    }

    public function adicionarlinhacaracteristicas()
    {
        $this->middleware('auth');
        $listaMolde = Molde::all();
        $listaCor = Cor::all();
        $listaTecido = Tecido::all();

        return view('produto.linhacaracteristicas',compact('listaMolde','listaCor','listaTecido'));
    }

    public function info($id)
    {
        if( !empty($id) ){

            $objProdutoCaracteristica = ProdutoCaracteristica::with(['produto','molde','tecido','cor'])
                ->where('pca_codigo','=',$id)
                ->first();

            if( is_object($objProdutoCaracteristica) ){
                return  $objProdutoCaracteristica->toJson();
            }
            return json_encode([],404);
        }
        return json_encode([],404);
    }
}
