<table>
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
    @for($i=1;$i<=$provinceCount;$i++) 
    <tr>
        <td>{{ $i }}</td>
        <td>{{ $provinceName[$i][0] }}</td>
        <td>{{ $provinceMicrowaveNode[$i][0] }}</td>
        <td>{{ $provinceVsatNode[$i][0] }}</td>
        <td>{{ $provinceOpticalfiberLink[$i][0] }}</td>
        <td>{{ $provinceBts[$i][0] }}</td>
    </tr>
    @endfor

</table>
