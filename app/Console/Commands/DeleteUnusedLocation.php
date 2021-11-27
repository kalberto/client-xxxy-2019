<?php

namespace App\Console\Commands;

use App\Model\Bairro;
use App\Model\Cidade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteUnusedLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteunusedlocation:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleta as localizações que não estão sendo utilizadas.';

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
	    $bairros_id = DB::table('bairros')
	                 ->join('enderecos','bairros.id','=','enderecos.bairro')
	                 ->join('predios', 'bairros.id', '=','predios.bairro')->groupBy('bairros.id')->select('bairros.id as id')->get()->pluck('id');
	    $unused_bairros = Bairro::whereNotIn('id',$bairros_id)->get();
	    foreach ($unused_bairros as $bairro){
		    $bairro->delete();
	    }
    }
}
