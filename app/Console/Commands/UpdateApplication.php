<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'application:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs update shell script which does a git pull and artisan migration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        // execute command
        exec(base_path().'/update', $output);

        // print output from command
        $this->comment( implode( PHP_EOL, $output ) );

        return 0;
    }
}
