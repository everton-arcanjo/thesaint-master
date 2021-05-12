<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\ProdutoCaracteristica;
use App\EstoqueProduto;

class Produto extends Model
{
    use SoftDeletes;

    protected $table = "produto";
    protected $primaryKey = "pro_id";
    protected $dates = ['deleted_at'];

    static public function salvarProdutoFinal($request, $id = null)
    {
        DB::beginTransaction();

        try{

            $produto = $request->input('tipo');
            $detalhes = $request->input('detalhe');
            $detalheTratado = [];

            $linha = 0;

            $detalheTratado = organizaArray($detalhes);

            if( is_null($id) ){

                $objProduto = new Produto();
                $objProduto->pro_tipo = $produto;
                $objProduto->save();



            }else{

                $objProduto = Produto::findOrFail($id);

                if( !is_object($objProduto) ){

                   return redirect('/produto');
                }

                $objProduto->pro_tipo = $produto;
                $objProduto->save();

            }

            if(count($detalheTratado)){

                if( count($detalheTratado) > 0 ){

                    foreach ($detalheTratado as $valor => $dados) {

                        if( isset($dados['pca_id']) ){

                            $objProdutoCaracteristica = ProdutoCaracteristica::where('pca_id','=',$dados['pca_id'])
                                ->first();

                            $manterRegistro[$dados['pca_id']] = $dados['pca_id'];

                            if(is_object($objProdutoCaracteristica)){

                                $valorProduto =  str_replace(['.',","],"",$dados['valor']);
                                $valorProduto = $valorProduto/100;
                                $valorProduto = number_format($valorProduto,2,".","");

                                $objProdutoCaracteristica->pca_codigo = $dados['codigo'];
                                $objProdutoCaracteristica->pca_mol_id = $dados['molde'];
                                $objProdutoCaracteristica->pca_tec_id = $dados['tecido'];
                                $objProdutoCaracteristica->pca_cor_id = $dados['cor'];
                                $objProdutoCaracteristica->pca_valor = $valorProduto;
                                $objProduto->caracterisrica()->save($objProdutoCaracteristica);

                            }

                        }else{

                                $valorProduto =  str_replace(['.',","],"",$dados['valor']);
                                $valorProduto = $valorProduto/100;
                                $valorProduto = number_format($valorProduto,2,".","");

                                $objProdutoCaracteristica =  new ProdutoCaracteristica();
                                $objProdutoCaracteristica->pca_codigo = $dados['codigo'];
                                $objProdutoCaracteristica->pca_mol_id = $dados['molde'];
                                $objProdutoCaracteristica->pca_tec_id = $dados['tecido'];
                                $objProdutoCaracteristica->pca_cor_id = $dados['cor'];
                                $objProdutoCaracteristica->pca_valor = $valorProduto;
                                $objProduto->caracterisrica()->save($objProdutoCaracteristica);

                                $objEstoqueProduto = new EstoqueProduto();
                                $objProdutoCaracteristica->estoque()->save($objEstoqueProduto);

                        }

                    }

                }
                if( count($manterRegistro) > 0 ){

                    ProdutoCaracteristica::whereNotIn('pca_id',$manterRegistro)
                    ->where('pca_pro_id','=',$id)
                    ->delete();
                }

            }

            DB::commit();

        }catch(Exception $e){

            DB::rollBack();
        }

    }

    public function caracterisrica()
    {
        return $this->hasMany('App\ProdutoCaracteristica', 'pca_pro_id', 'pro_id');
    }


}
