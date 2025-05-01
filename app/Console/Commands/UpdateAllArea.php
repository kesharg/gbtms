<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateAllArea extends Command
{
    protected $signature = 'update:area';

    protected $description = 'Updates all area on map(Province,District,VDC and Ward)';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->update_district_area();
        $this->update_vdc_area();
        $this->info("Area updated Successfully");
    }

    private function update_district_area()
    {
        $totalDistrict= DB::table('maps_district')->count();
        $currentInfrastructureInDistrictCount = 0;
        for ($i = 1; $i <= $totalDistrict; $i++) {
            $currentInfrastructureInDistrictCount = DB::select("SELECT ST_area(ST_transform(maps_district.geom,32645)) from maps_district where maps_district.gid=$i ");
            DB::table('maps_district')->where('gid', $i)->update(['total_area' => number_format((($currentInfrastructureInDistrictCount[0]->st_area) / 1000000), '0', '', '')]);
        }
    }

    private function update_vdc_area()
    {
        $totalVdc= DB::table('maps_vdc')->count();
        $eachVdcArea = 0;
        for ($i = 1; $i <= $totalVdc; $i++) {
            $eachVdcArea = DB::select("SELECT ST_area(ST_transform(maps_vdc.geom,32645)) from maps_vdc where maps_vdc.gid=$i");
            DB::table('maps_vdc')->where('gid', $i)->update(['total_area' => number_format((($eachVdcArea[0]->st_area) / 1000000), '0', '', '')]);
        }
    }
}
