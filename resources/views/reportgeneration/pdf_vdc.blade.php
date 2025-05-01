<!DOCTYPE html>
<html>

    <head>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td,
            th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
            .text-right {
                text-align: right !important;
            }
        </style>
    </head>

    <body>
        <div>
        <div  style="display:inline-flex;  width:100%; height:auto;">
            <img src="{{url('./img/logo.png')}}" style="height:120px; margin-top:20px;">
            <div style="text-align:center; margin-left:20%;">
                <h2 style="text-transform:uppercase;">Nepal Telecommunication Authority</h2>
                <h4 style="text-align:center; font-family:Monospace; border-style:solid; border-width:1px;">GIS BASED
                    TELECOMMUNICATION INFRASTRUCTURE <br>
                    MANAGEMENT INFORMATION SYSTEM
                </h4>
            </div>
        </div>
        </div>

        <div style="margin-top:-100px;">
            <h2 style="text-align: center;">NTA Vdc Data Report</h2>
            <p style="text-align:left;font-family:Monospace;">Date:{{ $todayDate }}
                <span style="float:right;font-family:Monospace;">Time:{{ $todayTime }}</span></p>
        </div>
        <div style=" border-style:solid;border-width:1px;border-radius:15px; ">
            <p style=" margin-left:10px;"><b>Total Microwave</b> = {{ $totalMicrowave }}<b
                    style=" margin-left:20px;">Total Vsat</b> =
                {{ $totalVsat }}<b style=" margin-left:20px;">Total Opticalfiber</b> =
                {{ $totalOpticalfibernode }}<b style=" margin-left:20px;">Total Systemsite</b> =
                {{ $totalSystemsites }}</p></br>
        </div>
        <hr style="margin-top:2.5em;margin-bottom:2.5em;">
        <table>
            <tr>
                <th colspan="6"></br>
                    <h3>VDC-wise Data</h3>
                </th>
            </tr>
            <tr>
                <th>SN.</th>
                <th>VDC Name</th>
                <th>Microwave Station</th>
                <th>Vsat</th>
                <th>Opticalfiber</th>
                <th>SystemSites</th>
            </tr>
            @for($i=1;$i<=$vdcCount;$i++) <tr>
                <td class="text-right">{{ $i }}</td>
                <td>{{ ucfirst(strtolower($vdcName[$i][0])) }}</td>
                <td class="text-right">{{ $vdcMicrowaveNode[$i][0] }}</td>
                <td class="text-right">{{ $vdcVsatNode[$i][0] }}</td>
                <td class="text-right">{{ $vdcOpticalfiberLink[$i][0] }}</td>
                <td class="text-right">{{ $vdcBts[$i][0] }}</td>
                </tr>
                @endfor

        </table>
        {{-- <p style="float:right;">System Developed By:<b>Innovative Solution Pvt. Ltd</b> </p> --}}
    </body>


</html>
