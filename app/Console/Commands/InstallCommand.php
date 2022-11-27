<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class InstallCommand extends Command
{
    protected $signature = 'shop:install';

    protected $description = 'Installation';

    public function handle(): int
    {
        $this->call('key:generate');
        $this->call('storage:link');
        $this->call('migrate', [
            '--seed' => true
        ]);
        $this->call('telegram-logger:publish');

        return CommandAlias::SUCCESS;
    }
}
