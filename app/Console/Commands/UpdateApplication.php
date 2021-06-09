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
        self::readFromProcess(base_path().'/update');

        return 0;
    }

    private static function readFromProcess(string $command): void
    {
        if (function_exists('proc_open')) {
            $descriptorSpec = [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ];

            $process = proc_open($command, $descriptorSpec, $pipes, null, null, ['suppress_errors' => true]);
            if (is_resource($process)) {
                stream_get_contents($pipes[1]);
                fclose($pipes[1]);
                fclose($pipes[2]);
                proc_close($process);
            }
        }
    }
}
