<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AuditoriasExport implements FromCollection,WithColumnFormatting, WithMapping,WithHeadings, ShouldAutoSize
{

	protected $auditorias;

	public function __construct(Collection &$auditorias)
	{
		$this->auditorias = $auditorias;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->auditorias;
    }

	/**
	 * @return array
	 */
	public function map($auditoria): array
	{
		return [
			$auditoria->id,
			$auditoria->codigo,
			$auditoria->tipo_nome,
			$auditoria->status_nome,
			date('d/m/Y H:i',strtotime($auditoria->created_at)),
			$auditoria->status != 'E' ? date('d/m/Y H:i',strtotime($auditoria->updated_at)) : '',
			$auditoria->auditor,
			$auditoria->consultor,
			$auditoria->observacoes,
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
			'E' => NumberFormat::FORMAT_DATE_DATETIME,
			'F' => NumberFormat::FORMAT_DATE_DATETIME,
			'G' => NumberFormat::FORMAT_TEXT,
			'H' => NumberFormat::FORMAT_TEXT,
			'I' => NumberFormat::FORMAT_TEXT,
		];
	}

	/**
	 * @return array
	 */
	public function headings(): array
	{
		return [
			'id_auditoria',
			'codigo_venda',
			'tipo_auditoria',
			'status_auditoria',
			'criado',
			'devolução/aprovação',
			'auditor',
			'consultor_venda',
			'observacoes_auditoria',
		];
	}
}
