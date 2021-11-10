<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Manager;
use App\Notifications\WeeklySummaryNotification;

class WeeklySummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:weeklysummary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send weekly update to manager every sunday by 1pm';

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
     * @return int
     */
    public function handle()
    {
        $managers = Manager::all();
        foreach($managers as $manager){
            $manager->notify(new WeeklySummaryNotification($manager));
            echo "done \n";
        }
    }
}
