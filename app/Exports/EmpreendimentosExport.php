<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class EmpreendimentosExport implements FromCollection,WithColumnFormatting, WithMapping,WithHeadings, ShouldAutoSize
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
    public function map($empreendimento): array
    {
	    $empreendimento_contatos = '';
	    foreach ($empreendimento->contato as $contato){
		    if($empreendimento_contatos != '')
			    $empreendimento_contatos .= "\r\n";
		    $empreendimento_contatos .= "Nome: $contato->nome, email: $contato->email, telefone: $contato->telefone, celular: $contato->celular";
	    }
    	return [
		    $empreendimento->id,
		    $empreendimento->nome,
		    $empreendimento->cliente_documento,
		    $empreendimento->consultor['consultor'],
		    $empreendimento->cep,
		    $empreendimento->uf['uf'],
		    $empreendimento->cidade->nome,
		    $empreendimento->bairro,
		    $empreendimento->logradouro,
		    $empreendimento->numero,
		    $empreendimento->complemento,
		    date('d/m/Y h:i',strtotime($empreendimento->created_at)),
		    $empreendimento_contatos,
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
			'K' => NumberFormat::FORMAT_TEXT,
			'L' => NumberFormat::FORMAT_DATE_DATETIME,
			'M' => NumberFormat::FORMAT_TEXT,
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
			'documento',
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
