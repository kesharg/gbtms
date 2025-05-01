<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use App\Vsat;
use App\System;
use App\Operator;
use App\Province;
use App\Microwave;
use App\Systemsite;
use App\Opticalfiber;
use App\Microwavestation;
use App\Opticalfiberlink;
use App\Infrastructurecode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport_district implements FromView, WithEvents{
    
    public function __construct()
    {
    }

    public function view(): View
    {   
        $todayDate = $this->getDate();
        $todayTime = $this->getTime();

        //Microwave Node
        $totalMicrowave = Microwave::count();
        //Opticalfiber Node
        $totalOpticalfibernode = Opticalfiber::count();
        //Vsat Node
        $totalVsat = Vsat::count();
        //BTS system towers
        $totalSystemsites = Systemsite::count();

        //Total count of administrative Unit
        $districtCount = DB::table( 'maps_district' )->count();
        for ( $district = 1; $district <= $districtCount; $district++ ) {
            $districtMicrowaveNode[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_microwavestation' );
            $districtName[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'district' );
            $districtVsatNode[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_vsat' );
            $districtOpticalfiberLink[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'opticalfiber_length' );
            $districtBts[$district] = DB::table( 'maps_district' )->where( 'gid', $district )->pluck( 'no_of_bts' );
        }
        return view( 'reportgeneration.exportCSV_district', compact(
            'totalMicrowave',
            'totalOpticalfibernode',
            'totalVsat',
            'totalSystemsites',
            //District info
            'districtCount',
            'districtName',
            'districtMicrowaveNode',
            'districtVsatNode',
            'districtOpticalfiberLink',
            'districtBts',
            //Extra info
            'todayDate',
            'todayTime',
        ) );
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                // Wraptext
             $event->sheet->getStyle('B')->getAlignment()->setWrapText(true);
          
            //  row height
             $event->sheet->getRowDimension(1)->setRowHeight(45);
             $event->sheet->getRowDimension(2)->setRowHeight(30);
            //  cell merge
             $event->sheet->mergeCells('A1:F1');
            // font size
            $event->sheet->getDelegate()->getStyle('1')->getFont()->setSize(18); 
            $event->sheet->getDelegate()->getStyle('2')->getFont()->setSize(22);  


            $event->sheet->getStyle('A1:F1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'c5d9f1'],]);
            $event->sheet->getStyle('A2:F2')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'b8cce4'],]);

            }
        ];
    }

    public function getDate() {
        date_default_timezone_set( 'Asia/Kathmandu' );

        return date( 'Y-m-d ' );

    }

    public function getTime() {
        date_default_timezone_set( 'Asia/Kathmandu' );
        return date( 'h:i:sa' );
    }

}
