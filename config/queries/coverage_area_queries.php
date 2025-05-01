<?php
return [

    "coverage_area_province" => [

        "coverage_area_2g_province" => "create materialized view if not exists coverage_area_2g_province as
        select st_area(st_transform(st_intersection(province.geom,st_union_2g.st_union),32645)),
        province.state_code from maps_province as province ,
        st_union_2g order by province.state_code;refresh materialized view coverage_area_2g_province",

        "coverage_area_3g_province" =>"create materialized view if not exists coverage_area_3g_province as
        select st_area(st_transform(st_intersection(province.geom,st_union_3g.st_union),32645)),
        province.state_code from maps_province as province ,
        st_union_3g order by province.state_code;refresh materialized view coverage_area_3g_province",

        "coverage_area_4g_province" =>"create materialized view if not exists coverage_area_4g_province as
        select st_area(st_transform(st_intersection(province.geom,st_union_4g.st_union),32645)),
        province.state_code from maps_province as province ,
        st_union_4g order by province.state_code;refresh materialized view coverage_area_4g_province"

    ],

    "coverage_area_district"=>[

        "coverage_area_2g_district"=>"create materialized view if not exists coverage_area_2g_district as
        select st_area(st_transform(st_intersection(district.geom,st_union_2g.st_union),32645)),
        district.gid from maps_district as district ,
        st_union_2g order by district.gid;refresh materialized view coverage_area_2g_district",

        "coverage_area_3g_district"=>"create materialized view if not exists coverage_area_3g_district as
        select st_area(st_transform(st_intersection(district.geom,st_union_3g.st_union),32645)),
        district.gid from maps_district as district ,
        st_union_3g order by district.gid;refresh materialized view coverage_area_3g_district",

        "coverage_area_4g_district"=>"create materialized view if not exists coverage_area_4g_district as
        select st_area(st_transform(st_intersection(district.geom,st_union_4g.st_union),32645)),
        district.gid from maps_district as district ,
        st_union_4g order by district.gid;refresh materialized view coverage_area_4g_district;"

    ],

    "coverage_area_vdc"=>[

        "coverage_area_2g_vdc"=>"create materialized view if not exists coverage_area_2g_vdc as
        select st_area(st_transform(st_intersection(vdc.geom,st_union_2g.st_union),32645)),
        vdc.gid from maps_vdc as vdc ,
        st_union_2g order by vdc.gid;refresh materialized view coverage_area_2g_vdc",

        "coverage_area_3g_vdc"=>"create materialized view if not exists coverage_area_3g_vdc as
        select st_area(st_transform(st_intersection(vdc.geom,st_union_3g.st_union),32645)),
        vdc.gid from maps_vdc as vdc ,
        st_union_3g order by vdc.gid;refresh materialized view coverage_area_3g_vdc",

        "coverage_area_4g_vdc"=>"create materialized view if not exists coverage_area_4g_vdc as
        select st_area(st_transform(st_intersection(vdc.geom,st_union_4g.st_union),32645)),
        vdc.gid from maps_vdc as vdc ,
        st_union_4g order by vdc.gid;refresh materialized view coverage_area_4g_vdc",

    ],
];
