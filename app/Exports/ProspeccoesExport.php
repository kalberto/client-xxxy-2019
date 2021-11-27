<?php

namespace App\Exports;

use App\Model\Fastpack\Auditoria;
use App\Model\Fastpack\Cliente;
use App\Model\Fastpack\Empreendimento;
use App\Model\Fastpack\Predio;
use App\Model\Fastpack\Venda;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProspeccoesExport implements FromCollection,WithColumnFormatting, WithMapping,WithHeadings, ShouldAutoSize
{
	protected $prospeccoes, $is_predio;

	public function __construct(Collection &$prospeccoes)
	{
		$this->prospeccoes = $prospeccoes;
		$this->is_predio = true;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->prospeccoes;
    }

	/**
	 * @return array
	 */
	public function map($prospeccao): array
	{
		$venda = Venda::find($prospeccao->codigo);
		if($prospeccao->is_empreendimento){
			$this->is_predio = false;
			$local = $this->map_local(false,$prospeccao->predio_id,$prospeccao->cliente['documento']);
		}else{
			$local = $this->map_local(true,$prospeccao->predio_id,$prospeccao->cliente['documento']);
		}
		$auditoria = Auditoria::where('codigo',$prospeccao->codigo)->latest()->first();
		$cliente = Cliente::find($prospeccao->cliente['documento']);
		$portado = '';
		$portados = '';
		$size = 0;
		if(isset($venda['produtos']['pacotes']['config']->voz->faixa_numeracao->lista_numeros)){
			$lista_numeros = $venda['produtos']['pacotes']['config']->voz->faixa_numeracao->lista_numeros;
			foreach ($lista_numeros as $key => $numero){
				if(isset($numero->portado) && $numero->portado == 'sim'){
					$portado = 'SIM';
					$portados .= isset($numero->operadora_doadora) ? (($portados ==''? '' : "\r\n").'FAIXA '.($key+1).': '.$numero->operadora_doadora) : '';
				}
				if(isset($numero->inicial) && isset($numero->final)){
					if($numero->inicial <= $numero->final)
						$size += ($numero->final - $numero->inicial) + 1;
				}
			}
		}
		$portado_0800 = '';
		$operadora_0800 = '';
		if(isset($venda['produtos']['0800']['config']->portado) && $venda['produtos']['0800']['config']->portado == 'sim'){
			$portado_0800 = 'SIM';
			if(isset($venda['produtos']['0800']['config']->operadora_doadora))
				$operadora_0800 = $venda['produtos']['0800']['config']->operadora_doadora;
		}
		$prospeccao_produtos = json_decode(json_encode($prospeccao->produtos),true);
		if(isset($venda->produtos))
			$venda_produtos = json_decode(json_encode($venda->produtos),true);
		else
			$venda_produtos = null;
		return [
			$local['def'],
			$local['id'],
			$local['nome'],
			$prospeccao->cliente['documento'],
			$cliente->nome,
			$cliente->inscricao_estadual,
			$local['logradouro'],
			$local['numero'],
			$local['complemento'],
			$local['bairro'],
			$local['cep'],
			$local['cidade'],
			$local['uf'],
			$local['cidade_abr'],
			$local['contatos'],
			$local['consultor'],
			$local['gerente'],
			$prospeccao->codigo,
			$prospeccao->usuario,
			$prospeccao->status_nome,
			$prospeccao->status_negociacao_nome,
			isset($prospeccao->venda_perdida->motivo) ? $prospeccao->venda_perdida->motivo : '',
			$prospeccao->observacoes,
			date('d/m/Y H:i',strtotime($prospeccao->created_at)),
			$prospeccao->status == 'V' ? date('d/m/Y H:i',strtotime($prospeccao->updated_at)) : '',
			$prospeccao->status == 'P' ? date('d/m/Y H:i',strtotime($prospeccao->updated_at)) : '',
			isset($prospeccao_produtos['pacotes']['nome']) ? $prospeccao_produtos['pacotes']['nome']: '',
			isset($prospeccao_produtos['cloudbackup']['nome']) ? 'Cloudbackup '.$prospeccao_produtos['cloudbackup']['nome']: '',
			isset($prospeccao_produtos['smartbox']['nome']) ? $prospeccao_produtos['smartbox']['nome']: '',
			isset($prospeccao_produtos['0800']['nome']) ? $prospeccao_produtos['0800']['nome']: '',
			isset($venda->codigo) ? $venda->codigo : 'Não possui',
			isset($venda->created_at) ? date('d/m/Y H:i',strtotime($venda->created_at)) : '',
			isset($venda) ? (isset($auditoria->tipo_nome) ? $auditoria->tipo_nome : 'Input') : 'Não possui',
			isset($venda->campanha) ? $venda->campanha : 'Não possui',
			isset($venda_produtos['pacotes']['nome']) ? $venda_produtos['pacotes']['nome'] : '',
			isset($venda_produtos['pacotes']['config']->voz->tecnologia) ? $venda_produtos['pacotes']['config']->voz->tecnologia.($venda_produtos['pacotes']['config']->voz->tecnologia == "Digital" ? $venda_produtos['pacotes']['config']->voz->tecnologia_sinalizacao : '' ) : '',
			$portado,
			$portados,
			$size,
			"INTERNET - A CONFIRMAR",
			isset($venda_produtos['cloudbackup']['nome']) ? 'Cloudbackup '.$venda_produtos['cloudbackup']['nome']: '',
			isset($venda_produtos['smartbox']['nome']) ? $venda_produtos['smartbox']['nome']: '',
			isset($venda_produtos['0800']['nome']) ? $venda_produtos['0800']['nome']: '',
			$portado_0800,
			$operadora_0800,
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
			'G' => NumberFormat::FORMAT_TEXT,
			'G' => NumberFormat::FORMAT_TEXT,
			'H' => NumberFormat::FORMAT_TEXT,
			'I' => NumberFormat::FORMAT_TEXT,
			'J' => NumberFormat::FORMAT_TEXT,
			'K' => NumberFormat::FORMAT_TEXT,
			'L' => NumberFormat::FORMAT_TEXT,
			'M' => NumberFormat::FORMAT_TEXT,
			'N' => NumberFormat::FORMAT_TEXT,
			'O' => NumberFormat::FORMAT_TEXT,
			'P' => NumberFormat::FORMAT_TEXT,
			'Q' => NumberFormat::FORMAT_TEXT,
			'R' => NumberFormat::FORMAT_TEXT,
			'S' => NumberFormat::FORMAT_TEXT,
			'T' => NumberFormat::FORMAT_TEXT,
			'U' => NumberFormat::FORMAT_TEXT,
			'V' => NumberFormat::FORMAT_TEXT,
			'W' => NumberFormat::FORMAT_DATE_DATETIME,
			'X' => NumberFormat::FORMAT_DATE_DATETIME,
			'Y' => NumberFormat::FORMAT_DATE_DATETIME,
			'Z' => NumberFormat::FORMAT_TEXT,
			'AA' => NumberFormat::FORMAT_TEXT,
			'AB' => NumberFormat::FORMAT_TEXT,
			'AC' => NumberFormat::FORMAT_TEXT,
			'AD' => NumberFormat::FORMAT_TEXT,
			'AE' => NumberFormat::FORMAT_DATE_DATETIME,
			'AF' => NumberFormat::FORMAT_TEXT,
			'AG' => NumberFormat::FORMAT_TEXT,
			'AH' => NumberFormat::FORMAT_TEXT,
			'AI' => NumberFormat::FORMAT_TEXT,
			'AJ' => NumberFormat::FORMAT_TEXT,
			'AK' => NumberFormat::FORMAT_TEXT,
			'AL' => NumberFormat::FORMAT_TEXT,
			'AM' => NumberFormat::FORMAT_TEXT,
			'AN' => NumberFormat::FORMAT_TEXT,
			'AO' => NumberFormat::FORMAT_TEXT,
			'AP' => NumberFormat::FORMAT_TEXT,
			'AQ' => NumberFormat::FORMAT_TEXT,
			'AR' => NumberFormat::FORMAT_TEXT,
			'AS' => NumberFormat::FORMAT_TEXT,
		];
	}

	/**
	 * @return array
	 */
	public function headings(): array
	{
		return [
			'empreendimento/predio',
			'local_codigo',
			'local_nome',
			'cliente_documento',
			'inscricao_estadual_cliente',
			'cliente_nome',
			'local_logradouro',
			'local_numero',
			'cliente_complemento',
			'local_bairro',
			'local_cep',
			'local_cidade',
			'local_uf',
			'local_regional',
			'local_contato',
			'local_consultor',
			'local_gerente',
			'prospeccao_codigo',
			'prospeccao_usuario',
			'prospeccao_status',
			'prospeccao_status_negociacao',
			'prospeccao_venda_perdida_motivo',
			'prospeccao_observacoes',
			'prospeccao_abertura',
			'prospeccao_concluida',
			'prospeccao_perdida',
			'prospeccao_pacote',
			'prospeccao_sva_backup',
			'prospeccao_sva_smartbox',
			'prospeccao_sva_0800',
			'venda_codigo',
			'venda_abertura',
			'venda_status',
			'venda_campanha',
			'venda_pacote',
			'venda_sinalizacao_voz',
			'venda_portabilidade_voz',
			'venda_operadora_doadora_voz',
			'venda_quantidade_ramais',
			'venda_internet',
			'venda_backup',
			'venda_smartbox',
			'venda_0800',
			'venda_portabilidade_0800',
			'venda_operadora_doadora_0800'
		];
	}

	public function map_local($is_predio, $predio_id, $documento){
		if($is_predio){
			$predio = Predio::find($predio_id);
			$predio_cliente = DB::table('predios_has_clientes')->where([['predio_id',$predio->getOriginal('id')],['cliente_documento',$documento]])->first();
			$predios_contatos = '';
			foreach ($predio->contato as $contato){
				if($predios_contatos != '')
					$predios_contatos .= "\r\n";
				$predios_contatos .= "Nome: $contato->nome, email: $contato->email, telefone: $contato->telefone, celular: $contato->celular";
			}
			return [
				'def' => 'predio',
				'id' => $predio_id,
				'nome' => $predio->nome,
				'logradouro' => $predio->logradouro,
				'numero' => $predio->numero,
				'complemento' => isset($predio_cliente->complemento) ? $predio_cliente->complemento : '',
				'bairro' => $predio->bairro,
				'cep' => $predio->cep,
				'cidade' => $predio->cidade->nome,
				'uf' => $predio->uf['uf'],
				'cidade_abr' => $predio->cidade->abr,
				'contatos' => $predios_contatos,
				'consultor' => $predio->consultor['consultor'],
				'gerente' => $predio->consultor['gerente']
			];
		}else{
			$empreendimento = Empreendimento::find($predio_id);
			$empreendimento_contatos = '';
			foreach ($empreendimento->contato as $contato){
				if($empreendimento_contatos != '')
					$empreendimento_contatos .= "\r\n";
				$empreendimento_contatos .= "Nome: $contato->nome, email: $contato->email, telefone: $contato->telefone, celular: $contato->celular";
			}
			return [
				'def' => 'emprendimento',
				'id' => $predio_id,
				'nome' => $empreendimento->nome,
				'logradouro' => $empreendimento->logradouro,
				'numero' => $empreendimento->numero,
				'complemento' => '',
				'bairro' => $empreendimento->bairro,
				'cep' => $empreendimento->cep,
				'cidade' => $empreendimento->cidade->nome,
				'uf' => $empreendimento->uf['uf'],
				'cidade_abr' => $empreendimento->cidade->abr,
				'contatos' => $empreendimento_contatos,
				'consultor' => $empreendimento->consultor['consultor'],
				'gerente' => $empreendimento->consultor['gerente']
			];
		}
	}
}
