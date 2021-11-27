<?php

namespace App\Console\Commands;

use App\Helpers\HTTAPI;
use App\Model\Cidade;
use App\Model\Uf;
use Illuminate\Console\Command;

class SynchronizeCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronizecities:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza as cidades da aplicação com as cidades da HTT';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    $cities = HTTAPI::getLocations();
	    if($cities['success'] == true && isset($cities['result']->locations)){
		    foreach ($cities["result"]->locations as $location){
			    if($location->type == "city"){
				    $uf = mb_strtoupper($location->uf,"UTF-8");
				    if(Uf::where([["ativo",true],["uf",$uf]])->count() == 0){
					    Uf::atualizar(["uf"=>$uf,"ativo"=>true],false);
				    }
				    $cidade = array(
					    "nome"              => $location->name,
					    "uf"                => $location->uf,
					    "abr"               => $location->abr,
					    "centro_operacao"   => $location->centroOperacao
				    );
				    Cidade::atualizar($cidade,false);
			    }
		    }
	    }
    }
}
