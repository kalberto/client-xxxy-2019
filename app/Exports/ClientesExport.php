<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ClientesExport implements FromCollection,WithColumnFormatting, WithMapping, WithHeadings, ShouldAutoSize
{

	protected $clientes;

	public function __construct(Collection &$clientes)
	{
		$this->clientes = $clientes;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->clientes;
    }

	public function map($cliente): array
	{
		$cliente_contatos = '';
		foreach ($cliente->contato as $contato){
			if($cliente_contatos != '')
				$cliente_contatos .= "\r\n";
			$cliente_contatos .= "Nome: $contato->nome, email: $contato->email, telefone: $contato->telefone, celular: $contato->celular";
		}
		return [
			$cliente->documento,
			$cliente->nome,
			$cliente->inscricao_estadual,
			$cliente->endereco->cep,
			$cliente->endereco->uf['uf'],
			$cliente->endereco->cidade->nome,
			$cliente->endereco->bairro,
			$cliente->endereco->logradouro,
			$cliente->endereco->numero,
			$cliente->endereco->complemento,
			date('d/m/Y h:i',strtotime($cliente->created_at)),
			$cliente_contatos,
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

	public function headings(): array
	{
		return [
			'documento',
			'nome',
			'inscricao_estadual',
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
