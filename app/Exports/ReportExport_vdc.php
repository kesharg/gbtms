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

class ReportExport_vdc implements FromView, WithEvents
{
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
        $vdcCount = DB::table( 'maps_vdc' )->count();
        for ( $vdc = 1; $vdc <= $vdcCount; $vdc++ ) {
            $vdcMicrowaveNode[$vdc] = DB::table( 'maps_vdc' )->where( 'gid', $vdc )->pluck( 'no_of_microwavestation' );
            $vdcName[$vdc] = DB::table( 'maps_vdc' )->where( 'gid', $vdc )->pluck( 'gapa_napa' );
            $vdcVsatNode[$vdc] = DB::table( 'maps_vdc' )->where( 'gid', $vdc )->pluck( 'no_of_vsat' );
            $vdcOpticalfiberLink[$vdc] = DB::table( 'maps_vdc' )->where( 'gid', $vdc )->pluck( 'opticalfiber_length' );
            $vdcBts[$vdc] = DB::table( 'maps_vdc' )->where( 'gid', $vdc )->pluck( 'no_of_bts' );
        }

        return view( 'reportgeneration.exportCSV_vdc', compact(
            'totalMicrowave',
            'totalOpticalfibernode',
            'totalVsat',
            'totalSystemsites',
            //District info
            'vdcCount',
            'vdcName',
            'vdcMicrowaveNode',
            'vdcVsatNode',
            'vdcOpticalfiberLink',
            'vdcBts',
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
             $event->sheet->getRowDimension(3)->setRowHeight(15);
            //  cell merge
             $event->sheet->mergeCells('A1:D1');
            // font size
            $event->sheet->getDelegate()->getStyle('1')->getFont()->setSize(22); 
            $event->sheet->getDelegate()->getStyle('2')->getFont()->setSize(16);  
            $event->sheet->getDelegate()->getStyle('3')->getFont()->setSize(12); 


            $event->sheet->getStyle('A1:D1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => '538dd5'],]);
            $event->sheet->getStyle('A2:D2')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'b8cce4'],]);
            $event->sheet->getStyle('A3:D3')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'c5d9f1'],]);

            $event->sheet->getDelegate()->getStyle('A1:D1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $event->sheet->getDelegate()->getStyle('C2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);    
            
            $event->sheet->getDelegate()->getStyle('A2:B2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
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
