<table>
    <tr>
        <th colspan="6">
            VDC-wise Data
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
        <td>{{ $i }}</td>
        <td>{{ $vdcName[$i][0] }}</td>
        <td>{{ $vdcMicrowaveNode[$i][0] }}</td>
        <td>{{ $vdcVsatNode[$i][0] }}</td>
        <td>{{ $vdcOpticalfiberLink[$i][0] }}</td>
        <td>{{ $vdcBts[$i][0] }}</td>
        </tr>
        @endfor

</table>
