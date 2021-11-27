<?php

namespace App\Console\Commands;

use App\Helpers\MediaHelper;
use Illuminate\Console\Command;

class DeleteTempFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deletetempfiles:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleta os arquivos temporarios gerados pelo site';

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
	    $directories = [public_path().'/'.'upload/temp/'];
	    foreach ($directories as $directory){
		    $files = array_slice(scandir($directory), 2);
		    foreach ($files as $file){
			    MediaHelper::delete_file($directory,$file);
		    }
	    }
	    $directory = public_path().'/upload/using/';
	    $files = array_slice(scandir($directory),2);
	    foreach ($files as $file){
		    MediaHelper::move_file($directory,public_path().'/upload/temp/',$file);
	    }
    }
}
