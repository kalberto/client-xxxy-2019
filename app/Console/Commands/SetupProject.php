<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SetupProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setupproject';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
	    if ($this->confirm('Isso irá apagar seu banco de dados. Tem certeza que deseja continuar?')) {
		    if ($this->confirm('Todas as informações serão apagadas. Realmente tem certeza que deseja continuar?')) {
			    Artisan::call('migrate:fresh');
			    Artisan::call('passport:install');
			    Artisan::call('db:seed');
			    if(DB::table('pg_available_extensions')->where('name','=','unaccent')->count() > 0)
				    DB::statement('CREATE EXTENSION IF NOT EXISTS unaccent');
			    Artisan::call('synchronizeusers:cron');
			    Artisan::call('synchronizecities:cron');
		    }
	    }

    }
}
