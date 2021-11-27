<?php

namespace App\Console\Commands\CreateComponentVue;

use Illuminate\Console\Command;

class CreateComponentVue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:component 
                    {--name= : Define o nome para o component}
                    {--view : Cria o component como uma view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria components do Vue.js';

    /**
     * The name of component.
     *
     * @var string
     */
    protected $name = '';

    /**
     * The name of component.
     *
     * @var array
     */
    protected $fields = ['stylus'];

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
        if ( empty($this->option('name')) ) {
            $this->error('The name argument are required!');
            return;
        }

        $this->name = $this->option('name');

        $this->createDirectories();
        $this->exportVue();

    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function createDirectories()
    {
        if (! is_dir($directory = $this->getVuePath('components'))) {
            mkdir($directory, 0755, true);
        }

        if (! is_dir($directory = $this->getVuePath('views')) && $this->option('view')) {
            mkdir($directory, 0755, true);
        }

        if (! is_dir($directory = $this->getVuePath('components/' . $this->camelCase($this->name, true))) && !$this->option('view')) {
            mkdir($directory, 0755, true);
        }

        if (! is_dir($directory = $this->getVuePath('views/'. $this->camelCase($this->name, true))) && $this->option('view')) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Export the authentication views.
     *
     * @return void
     */
    protected function exportVue()
    {
        $componentLocal = 'components';
        if ($this->option('view'))
            $componentLocal = 'views';

        if ( file_exists($view = $this->getVuePath( implode(DIRECTORY_SEPARATOR, [$componentLocal, $this->camelCase($this->name, true), $this->camelCase($this->name) . '.vue']) )) ) {
            if (! $this->confirm("The [{$this->name}] component already exists. Do you want to replace it?")) {
                return;
            }
        }
        
        $vueFile = fopen(__DIR__ . '/stubs/make/components/vue.stub', 'r');
        $componentFile = fopen($view, 'w+');
        while((($buffer = fgets($vueFile, 4096)) !== false)) {
            $line = $buffer;
            foreach ($this->fields as $field){
                if(strpos($buffer, '%' . $field . '%') !== false){
                    if($field == 'stylus')
                    $line = str_replace('%'.$field.'%', $this->camelCase($this->name), $buffer);
                }
            }
            fwrite($componentFile, $line);
        }
        fclose($vueFile);
        fclose($componentFile);
        
        copy(__DIR__ . '/stubs/make/components/styl.stub', 
            $this->getVuePath( implode(DIRECTORY_SEPARATOR, [$componentLocal, $this->camelCase($this->name, true), $this->camelCase($this->name) . '.styl'])));
    }
    
    /**
     * Get full view path relative to the app's configured view path.
     *
     * @param  string  $path
     * @return string
     */
    protected function getVuePath($path)
    {
        return implode(DIRECTORY_SEPARATOR, [ config('vue.paths')[0] ?? resource_path('vue'), $path ]);
    }

    /**
     * Make string as Pascal Case
     *
     * @param  string  $str
     * @return string
     */
    protected function camelCase($str, $lower=false)
    {
        $str = preg_replace('/[^a-z0-9]+/i', ' ', $str);
        $str = trim($str);
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);
        if ($lower)
            $str = lcfirst($str);
        return $str;
    }
}