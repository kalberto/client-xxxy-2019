<?php

namespace App\Console\Commands;

use App\Helpers\HTTAPI;
use App\Model\Perfil;
use App\Model\Usuario;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SynchronizeUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronizeusers:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza os usuários da aplicação com os usuários do AD da HTT';

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
    	DB::table('usuarios')->where('ativo',true)->update(['ativo' => false]);
        $users = HTTAPI::getUsers();
        if($users['success'] == true){
        	foreach ($users['result'] as $user){
        		$user_data = HTTAPI::getUser($user);
        		if($user_data['success'] == true){
			        $user_db = Usuario::updateOrCreate(
				        array(
					        'usuario' => $user
				        ),
				        array(
				        	'ativo' => true
				        )
			        );
			        $user_db->updateUser($user_data['result']);
		        }
	        }
        }
    }
}
