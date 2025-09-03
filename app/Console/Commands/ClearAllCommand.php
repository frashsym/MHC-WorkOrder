<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCommand extends Command
{
    // Nama command yang akan dipanggil di terminal
    protected $signature = 'clear:all';

    // Deskripsi command
    protected $description = 'Clear all caches (config, route, view, event, compiled)';

    public function handle()
    {
        $this->info('Clearing cache...');

        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('event:clear');
        $this->call('clear-compiled');

        $this->info('All caches cleared!');
    }
}
