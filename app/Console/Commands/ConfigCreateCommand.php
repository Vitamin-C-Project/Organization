<?php

namespace App\Console\Commands;

use App\Models\Config;
use Illuminate\Console\Command;

class ConfigCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:config-create {key : The key of the config} {type? : The type of the config}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new config';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = $this->argument('key');
        $type = $this->argument('type');

        if (!$type) {
            $type = 'text';
        } else {
            if (in_array($type, ['text', 'file']) == false) {
                $this->error('Config type must be text or file');
                return;
            }
        }

        $config = Config::where('key', $key)->first();

        if ($config) {
            $this->error('Config already exists');
            return;
        } else {
            $config = Config::create([
                'key' => $key,
                'value' => '',
                'type' => $type
            ]);
            $this->info('Config created successfully');
            return;
        }
    }
}
