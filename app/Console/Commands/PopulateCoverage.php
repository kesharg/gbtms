<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class PopulateCoverage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PopulateCoverage:activate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creates or replaces function to populate coverage database when new tab file is imported.';

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
        $start_time=time();
        Log::info("populate coverage_data and create/replace function");
        Log::info("Job started at : " . date("F j, Y, g:i a"));
        
        //to re-populate coverage_data and create/replace function
        DB::unprepared(Config::get('queries.coverage_data_populate.create_function'));

        $end_time=time();
        Log::info("Job ended at : " . date("F j, Y, g:i a"));
        Log::info('Total execution time : '. ($end_time-$start_time).'seconds');
        $this->info('coverage data function: fnc_repopulate_coveragedata is ready to use!');
    }
}
