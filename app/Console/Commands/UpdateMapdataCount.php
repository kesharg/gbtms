<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class UpdateMapdataCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:mapsdatacount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'updates maps_province, district, vdc and ward counts.';

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
        \Log::info("updates mapsdataCount in maps_province, district, vdc and ward counts for the first time");
        Log::info("Job started at : " . date("F j, Y, g:i a"));
        DB::unprepared(Config::get('fncntgr.fnc_update_tbl_allcount.fnc_updt_mapsdatacount'));
        \Log::info("Functions Created successfully!");

        DB::unprepared(Config::get('fncntgr.fnc_update_tbl_allcount.updt_tbl_vsat'));
        \Log::info("Updated no_of_vsat");

        DB::unprepared(Config::get('fncntgr.fnc_update_tbl_allcount.updt_tbl_bts'));
        \Log::info("Updated no_of_bts");

        DB::unprepared(Config::get('fncntgr.fnc_update_tbl_allcount.updt_tbl_microwavestation'));
        \Log::info("Updated no_of_microwavestation");
        
        DB::unprepared(Config::get('fncntgr.fnc_update_tbl_allcount.updt_tbl_opticalfiber'));
        \Log::info("Updated no_of_opticalfiber");

        // DB::unprepared(Config::get('fncntgr.fnc_update_tbl_allcount.updt_tbl_pstn'));
        // \Log::info("Updated no_of_pstn");

        // DB::unprepared(Config::get('fncntgr.fnc_update_tbl_allcount.updt_tbl_wireless'));
        // \Log::info("Updated no_of_wireless");

        $end_time=time();
        Log::info("Job ended at : " . date("F j, Y, g:i a"));
        Log::info('Total execution time : '. ($end_time-$start_time).'seconds');
        $this->info('MapsdataCount updated successfully!');
    }
}
