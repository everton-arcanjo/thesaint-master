<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cliente extends Model
{
    use SoftDeletes;

    protected $table = "cliente";
    protected $primaryKey = "cli_id";
    protected $dates = ['deleted_at'];
    //protected $fillable = ['cli_id','cli_cnpj','cli_razao_social','cli_nome_fantasia','cli_inscricao_estadual'];

    public function contato()
    {
        return $this->hasOne('App\ClienteContato', 'cco_cli_id', 'cli_id');
    }

    public function endereco()
    {
        return $this->hasOne('App\ClienteEndereco', 'cen_cli_id', 'cli_id');
    }

    public function pedido()
    {
        return $this->hasMany('App\Pedido', 'ped_cli_id', 'cli_id');
    }

    public static function atualiza($cliente, $id)
    {

        $objCliente = self::findOrFail($id);
        $objCliente->cli_cnpj = $cliente['cnpj'];
        $objCliente->cli_razao_social = $cliente['razao_socia'];
        $objCliente->cli_nome_fantasia = $cliente['nome_fantasia'];
        $objCliente->cli_inscricao_estadual = $cliente['inscricao_estadual'];
        $objCliente->save();

        $objClienteContato = $objCliente->contato;
        $objClienteContato->cco_nome_contato = $cliente['contato'];
        $objClienteContato->cco_telefone_comercial = $cliente['telefone'];
        $objClienteContato->cco_celular = $cliente['celular'];
        $objClienteContato->cco_email = $cliente['email'];
        $objCliente->contato()->save($objClienteContato);

        $objClienteEndereco = $objCliente->endereco;
        $objClienteEndereco->cen_cep = $cliente['cep'];
        $objClienteEndereco->cen_endereco = $cliente['endereco'];
        $objClienteEndereco->cen_numero = $cliente['numero'];
        $objClienteEndereco->cen_complemento = $cliente['complemento'];
        $objClienteEndereco->cen_bairro = $cliente['bairro'];
        $objClienteEndereco->cen_cidade = $cliente['cidade'];
        $objClienteEndereco->cen_estado = $cliente['estado'];
        $objCliente->endereco()->save($objClienteEndereco);

        return $objCliente;
    }

}
