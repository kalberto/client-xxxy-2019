<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckExpiredVf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkexpiredvf:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica todas as vf para ver quais estão expiradas';

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
        DB::table("clientes")->where([['status','A'],['data_verificacao','<',date('Y-m-d')]])->update(array('status'=>'E'));
    }
}
