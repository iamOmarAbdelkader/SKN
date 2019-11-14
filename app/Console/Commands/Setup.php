<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Artisan;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'basic setup for the app';

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
        $this->line('generating storage link shortcut...');
        Artisan::call('storage:link');
        $this->line('migrating the db...');
        Artisan::call('migrate:fresh');
        $this->line('Done!');

    }
}
