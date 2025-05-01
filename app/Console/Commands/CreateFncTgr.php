<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class CreateFncTgr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:fnctgr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates triggers and functions in tables for mapdataCount';

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
        \Log::info("Triggers and Functions Created");
        Log::info("Job started at : " . date("F j, Y, g:i a"));
        DB::unprepared(Config::get('fncntgr.fnctgr_tbl_vsats.fnc_tbl_vsats'));
        DB::unprepared(Config::get('fncntgr.fnctgr_tbl_vsats.tgr_tbl_vsats'));
        \Log::info("created for table vsats");

        DB::unprepared(Config::get('fncntgr.fnctgr_tbl_bts.fnc_tbl_bts'));
        DB::unprepared(Config::get('fncntgr.fnctgr_tbl_bts.tgr_tbl_bts'));
        \Log::info("created for table bts");

        DB::unprepared(Config::get('fncntgr.fnctgr_tbl_microwavestation.fnc_tbl_microwavestation'));
        DB::unprepared(Config::get('fncntgr.fnctgr_tbl_microwavestation.tgr_tbl_microwavestation'));
        \Log::info("created for table microwavestation");

        DB::unprepared(Config::get('fncntgr.fnctgr_tbl_pstn.fnc_tbl_pstn'));
        DB::unprepared(Config::get('fncntgr.fnctgr_tbl_pstn.tgr_tbl_pstn'));
        \Log::info("created for table pstn");

        DB::unprepared(Config::get('fncntgr.fnctgr_tbl_wireless.fnc_tbl_wireless'));
        DB::unprepared(Config::get('fncntgr.fnctgr_tbl_wireless.tgr_tbl_wireless'));
        \Log::info("created for table wireless");

        $end_time=time();
        Log::info("Job ended at : " . date("F j, Y, g:i a"));
        Log::info('Total execution time : '. ($end_time-$start_time).'seconds');
        $this->info('Triggers and Functions Created successfully!');
    }
}
