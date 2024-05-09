<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearTable extends Command
{
    protected $signature = 'table:clear';

    protected $description = 'Clear the table';

    public function handle()
    {
        DB::table('users')->truncate();

        $this->info('Table cleared successfully!');
    }
}
