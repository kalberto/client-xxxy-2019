<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 05/08/2019
 * Time: 08:36
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 05/08/2019
 * Time: 08:36
 */

namespace App\Imports;

use App\Helpers\LocationHelper;
use App\Http\Traits\ImportProgressSheet;
use App\Model\Fastpack\Cliente;
use App\Model\Fastpack\Help\Endereco;
use App\Model\Fastpack\Relationship\PredioHasCliente;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientesImport implements ToModel, WithHeadingRow {

	use Importable, ImportProgressSheet;

	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function model(array $row)
	{
		$this->SendProgress();
		if($row['documento'] == '' && $row['nome'] == '')
			return null;
		$cidade_id = $cidade_id = LocationHelper::getCidadeId($row["uf"],$row["cidade"],false);
		$endereco = array(
			'cep' => $row['cep'],
			'cidade' => array('id' => $cidade_id),
			'bairro' => LocationHelper::getBairroId($row['bairro'],$cidade_id,false),
			'logradouro' => $row['logradouro'],
			'numero' => $row['numero'],
			'complemento' => $row['complemento']
		);
		$cliente = Cliente::firstOrCreate(
			["documento"=>$row['documento']],
			[
				"nome" => $row["nome"],
				"inscricao_estadual" => isset($row["inscricao_estadual"]) ? $row["inscricao_estadual"] : null,
				"contato" => isset($row["contato"]) ? $row["contato"] : [],
				"endereco" => Endereco::salvar($endereco,false)->id
			]
		);
		if(isset($row["predios"])){
			PredioHasCliente::where("cliente_documento", $cliente->documento)->delete();
			$predios_ids = explode(',',$row["predios"]);
			foreach ($predios_ids as $predios_id){
				$data = ["cliente_documento" => $cliente->documento,"predio_id" => preg_replace("/[^0-9]/", '', $predios_id)];
				PredioHasCliente::criar($data,null);
			}
		}
		return $cliente;
	}
}