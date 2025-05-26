<?php

namespace App\Console\Commands;

use App\Models\Config;
use Illuminate\Console\Command;

class ConfigDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:config-delete {key : The key of the config}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a config';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = $this->argument('key');

        $config = Config::where('key', $key)->first();

        if (!$config) {
            $this->error('Config does not exist');
            return;
        } else {
            Config::where('key', $key)->delete();
            $this->info('Config deleted successfully');
            return;
        }
    }
}
