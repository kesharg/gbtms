<table>
    <tr>
        <th colspan="6">
            District-wise Data
        </th>
    </tr>
    <tr>
        <th>SN.</th>
        <th>District Name</th>
        <th>Microwave Station</th>
        <th>Vsat</th>
        <th>Opticalfiber</th>
        <th>SystemSites</th>
    </tr>
    @for($i=1;$i<=$districtCount;$i++) <tr>
        <td>{{ $i }}</td>
        <td>{{ ucfirst(strtolower($districtName[$i][0])) }}</td>
        <td>{{ $districtMicrowaveNode[$i][0] }}</td>
        <td>{{ $districtVsatNode[$i][0] }}</td>
        <td>{{ $districtOpticalfiberLink[$i][0] }}</td>
        <td>{{ $districtBts[$i][0] }}</td>
        </tr>
        @endfor

</table>
