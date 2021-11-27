<?php

namespace App\Exports;

use App\Model\Fastpack\Predio;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PrediosExport implements FromCollection,WithColumnFormatting, WithMapping,WithHeadings, ShouldAutoSize
{

	protected $predios;

	public function __construct(Collection &$predios)
	{
		$this->predios = $predios;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->predios;
    }

	/**
	 * @return array
	 */
    public function map($item): array
    {
    	$predio = Predio::find($item->id);
	    $predios_contatos = '';
	    foreach ($predio->contato as $contato){
		    if($predios_contatos != '')
			    $predios_contatos .= "\r\n";
		    $predios_contatos .= "Nome: $contato->nome, email: $contato->email, telefone: $contato->telefone, celular: $contato->celular";
	    }
    	return [
    		$predio->id,
    		$predio->nome,
    		$item->usuario,
    		$predio->cep,
    		$predio->uf['uf'],
    		$predio->cidade->nome,
    		$predio->bairro,
    		$predio->logradouro,
    		$predio->numero,
    		$predio->complemento,
		    date('d/m/Y h:i',strtotime($predio->created_at)),
		    $predios_contatos,
	    ];
    }

	/**
	 * @return array
	 */
	public function columnFormats(): array
	{
		return [
			'A' => NumberFormat::FORMAT_TEXT,
			'B' => NumberFormat::FORMAT_TEXT,
			'C' => NumberFormat::FORMAT_TEXT,
			'D' => NumberFormat::FORMAT_TEXT,
			'E' => NumberFormat::FORMAT_TEXT,
			'F' => NumberFormat::FORMAT_TEXT,
			'G' => NumberFormat::FORMAT_TEXT,
			'H' => NumberFormat::FORMAT_TEXT,
			'I' => NumberFormat::FORMAT_TEXT,
			'J' => NumberFormat::FORMAT_TEXT,
			'K' => NumberFormat::FORMAT_DATE_DATETIME,
			'L' => NumberFormat::FORMAT_TEXT,
		];
	}

	/**
	 * @return array
	 */
	public function headings(): array
	{
		return [
			'identificador',
			'nome',
			'consultor',
			'cep',
			'uf',
			'cidade',
			'bairro',
			'logradouro',
			'numero',
			'complemento',
			'criado',
			'contato',
		];
	}
}
