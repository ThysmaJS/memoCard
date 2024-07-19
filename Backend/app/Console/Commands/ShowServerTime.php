<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class ShowServerTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show the current server date and time';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Current server date and time is: ' . Carbon::now());
        return 0;
    }
}
