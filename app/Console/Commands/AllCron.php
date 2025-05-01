<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class AllCron extends Command
{
    protected $signature = 'all:cron';

    protected $description = 'This command executes all scheduled jobs for NTA database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $start_time=time();
        Log::info("Job started at : " . date("F j, Y, g:i a"));
        $this->materialized_view_valid_coverage_data();
        $this->materialized_view_st_union_coverage();
        $this->materialized_view_coverage_province();
        $this->materialized_view_coverage_district();
        $this->materialized_view_coverage_vdc();
        $end_time=time();
        Log::info("Job ended at : " . date("F j, Y, g:i a"));
        Log::info('Total execution time : '. ($end_time-$start_time).'seconds');
        $this->info('All:Cron Command Run successfully!');
    }

    private function materialized_view_valid_coverage_data(){
        $start_time=time();
        Log::info('Materialized view of coverage data with geoms made valid started at : '. date("F j, Y, g:i a"));
        Log::info('********************************************************************************************');

        DB::unprepared(Config::get('queries.coverage_data_populate.create_valid_mview'));

        $end_time=time();
        Log::info('********************************************************************************************');
        Log::info('Materialized view of coverage data with geoms made valid started at : '. date("F j, Y, g:i a"));
        Log::info('Execution time for makeing valid geom from coverage_data() : '. ($end_time-$start_time).'seconds');
    }

    private function materialized_view_st_union_coverage(){
        $start_time=time();
        Log::info('Materialized view for st_union coverage started at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for 2G st_union coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.st_union.st_union_2g_query'));
        Log::info('Materialized view for 2G st_union coverage ended at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for 3G st_union coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.st_union.st_union_3g_query'));
        Log::info('Materialized view for 3G st_union coverage ended at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for 4G st_union coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.st_union.st_union_4g_query'));
        Log::info('Materialized view for st_union coverage ended at : '. date("F j, Y, g:i a"));
        $end_time=time();

        Log::info('********************************************************************************************');

        Log::info('Materialized view for st_union coverage ended at : '. date("F j, Y, g:i a"));
        Log::info('Execution time for st_union_coverage() : '. ($end_time-$start_time).'seconds');
    }

    private function materialized_view_coverage_province()
    {
        $start_time=time();
        Log::info('Materialized view for province coverage started at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for province 2G coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.coverage_area_province.coverage_area_2g_province'));
        Log::info('Materialized view for province 2G coverage ended at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for province 3G coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.coverage_area_province.coverage_area_3g_province'));
        Log::info('Materialized view for province 3G coverage ended at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for province 4G coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.coverage_area_province.coverage_area_4g_province'));
        Log::info('Materialized view for province 4G coverage ended at : '. date("F j, Y, g:i a"));
        $end_time=time();

        Log::info('********************************************************************************************');

        Log::info('Materialized view for province coverage ended at : '. date("F j, Y, g:i a"));
        Log::info('Execution time for materialized_view_coverage_province() : '. ($end_time-$start_time).' seconds');
    }



    private function materialized_view_coverage_district()
    {
        $start_time=time();
        Log::info('Materialized view for district coverage started at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for district 2G coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.coverage_area_district.coverage_area_2g_district'));
        Log::info('Materialized view for district 2G coverage ended at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for district 3G coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.coverage_area_district.coverage_area_3g_district'));
        Log::info('Materialized view for district 3G coverage ended at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for district 4G coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.coverage_area_district.coverage_area_4g_district'));
        Log::info('Materialized view for district 4G coverage ended at : '. date("F j, Y, g:i a"));
        $end_time=time();

        Log::info('********************************************************************************************');

        Log::info('Materialized view for district coverage ended at : '. date("F j, Y, g:i a"));
        Log::info('Execution time for materialized_view_coverage_district() : '. ($end_time-$start_time).'seconds');
    }

    private function materialized_view_coverage_vdc()
    {
        $start_time=time();
        Log::info('Materialized view for vdc coverage started at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for vdc 2G coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.coverage_area_vdc.coverage_area_2g_vdc'));
        Log::info('Materialized view for vdc 2G coverage ended at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for vdc 3G coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.coverage_area_vdc.coverage_area_3g_vdc'));
        Log::info('Materialized view for vdc 3G coverage ended at : '. date("F j, Y, g:i a"));

        Log::info('********************************************************************************************');

        Log::info('Materialized view for vdc 4G coverage started at : '. date("F j, Y, g:i a"));
        DB::unprepared(Config::get('queries.coverage_area_vdc.coverage_area_4g_vdc'));
        Log::info('Materialized view for vdc 4G coverage ended at : '. date("F j, Y, g:i a"));
        $end_time=time();

        Log::info('********************************************************************************************');

        Log::info('Materialized view for vdc coverage ended at : '. date("F j, Y, g:i a"));
        Log::info('Execution time for materialized_view_coverage_vdc() : '. ($end_time-$start_time).'seconds');
    }
}
