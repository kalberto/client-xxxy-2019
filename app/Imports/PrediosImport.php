<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 01/08/2019
 * Time: 14:05
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 01/08/2019
 * Time: 14:05
 */

namespace App\Imports;

use App\Helpers\LocationHelper;
use App\Http\Traits\ImportProgressSheet;
use App\Model\Fastpack\Predio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PrediosImport implements ToModel, WithHeadingRow {

	use Importable, ImportProgressSheet;

	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function model(array $row)
	{
		$this->SendProgress();
		if($row['nome'] == '' && $row['logradouro'] == '')
			return null;
		$cidade_id = LocationHelper::getCidadeId($row["uf"],$row["cidade"],false);
		return new Predio([
			'nome' => $row['nome'],
			'logradouro' => $row['logradouro'],
			'numero' => $row['numero'],
			'complemento' => $row['complemento'],
			'consultor_id' => DB::table("usuarios")->select("consultores.id")->join("consultores","usuarios.id","consultores.usuario_id")->where("usuarios.usuario",$row["consultor"])->pluck("consultores.id")->first(),
			'cidade_id' => $cidade_id,
			'regional' => isset($row['regional']) ? $row['regional'] : '',
			'cep' => LocationHelper::getCepId($row['cep'],false),
			'bairro' => LocationHelper::getBairroId($row['bairro'],$cidade_id,false),
			'abordado' => isset($row['abordado']) && $row['abordado'] == 'S' ? true : false,
			'ativo' => isset($row['ativo']) && $row['ativo'] == 'S' ? true : false
		]);
	}
}