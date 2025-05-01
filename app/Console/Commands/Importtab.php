<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class Importtab extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tab';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs create foreign server and foreign schema for tab files of coverage data';

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
        Log::info("Job started at : " . date("F j, Y, g:i a"));
        // DB::unprepared(Config::get('queries.tab_file.drop_and_create_server_local'));
        DB::unprepared(Config::get('queries.tab_file.drop_and_create_server_devserver'));
        // DB::unprepared(Config::get('queries.tab_file.drop_and_create_server_mainserver'));
        DB::unprepared(Config::get('queries.tab_file.drop_and_create_schema'));
        DB::unprepared(Config::get('queries.tab_file.import_tab_file'));

        $end_time=time();
        Log::info("Job ended at : " . date("F j, Y, g:i a"));
        Log::info('Total execution time : '. ($end_time-$start_time).'seconds');
        $this->info('foreign server and schema recreated and tab files imported successfully!');
    }
}
