<table>
    <tr>
        <th colspan="6">
            Operator-wise Data
        </th>
    </tr>
    <tr>
        <th>SN.</th>
        <th>Operator Name</th>
        <th>Microwave Station</th>
        <th>Vsat</th>
        <th>Opticalfiber</th>
        <th>SystemSites</th>
    </tr>
    @for($i=0;$i<$totalOperator;$i++) 
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $operatorName[$i] }}</td>
            <td>{{ $microwaveNode[$i] }}</td>
            <td>{{ $vsatNode[$i] }}</td>
            <td>{{ $opticalfiberNode[$i] }}</td>
            <td>{{ $systemSiteNode[$i] }}</td>
        </tr>
    @endfor


    <tr>
        <th colspan="6">
            Province-wise Data
        </th>
    </tr>
    <tr>
        <th>SN.</th>
        <th>Province Name</th>
        <th>Microwave Station</th>
        <th>Vsat</th>
        <th>Opticalfiber</th>
        <th>SystemSites</th>
    </tr>
    @for($i=1;$i<=$provinceCount;$i++) <tr>
        <td>{{ $i }}</td>
        <td>{{ $provinceName[$i][0] }}</td>
        <td>{{ $provinceMicrowaveNode[$i][0] }}</td>
        <td>{{ $provinceVsatNode[$i][0] }}</td>
        <td>{{ $provinceOpticalfiberLink[$i][0] }}</td>
        <td>{{ $provinceBts[$i][0] }}</td>
        </tr>
    @endfor

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
