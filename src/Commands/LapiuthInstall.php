<?php

namespace Datakrama\Lapiuth\Commands;

use Illuminate\Console\Command;

class LapiuthInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lapiuth:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install or reinstall Lapiuth';

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
        $this->info('Publish all required components.');
        $this->call('vendor:publish', ['--provider' => 'Datakrama\Lapiuth\LapiresServiceProvider']);
        $this->info('Done.');
    }
}
