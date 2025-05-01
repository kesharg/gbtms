<?php
return [

    "coverage_area_province" => [

        "coverage_area_2g_province" => "
            create materialized view if not exists coverage_area_2g_province as
                select st_area(st_transform(st_intersection(province.geom,st_union_2g.st_union),32645)),
                province.state_code from maps_province as province ,
                st_union_2g order by province.state_code WITH NO DATA;
            refresh materialized view coverage_area_2g_province",

        "coverage_area_3g_province" =>"
            create materialized view if not exists coverage_area_3g_province as
                select st_area(st_transform(st_intersection(province.geom,st_union_3g.st_union),32645)),
                province.state_code from maps_province as province ,
                st_union_3g order by province.state_code WITH NO DATA;
            refresh materialized view coverage_area_3g_province",

        "coverage_area_4g_province" =>"
            create materialized view if not exists coverage_area_4g_province as
                select st_area(st_transform(st_intersection(province.geom,st_union_4g.st_union),32645)),
                province.state_code from maps_province as province ,
                st_union_4g order by province.state_code WITH NO DATA;
            refresh materialized view coverage_area_4g_province"

    ],

    "coverage_area_district"=>[

        "coverage_area_2g_district"=>"
            create materialized view if not exists coverage_area_2g_district as
                select st_area(st_transform(st_intersection(district.geom,st_union_2g.st_union),32645)),
                district.gid from maps_district as district ,
                st_union_2g order by district.gid WITH NO DATA;
            refresh materialized view coverage_area_2g_district",

        "coverage_area_3g_district"=>"
            create materialized view if not exists coverage_area_3g_district as
                select st_area(st_transform(st_intersection(district.geom,st_union_3g.st_union),32645)),
                district.gid from maps_district as district ,
                st_union_3g order by district.gid WITH NO DATA;
            refresh materialized view coverage_area_3g_district",

        "coverage_area_4g_district"=>"
            create materialized view if not exists coverage_area_4g_district as
                select st_area(st_transform(st_intersection(district.geom,st_union_4g.st_union),32645)),
                district.gid from maps_district as district ,
                st_union_4g order by district.gid WITH NO DATA;
            refresh materialized view coverage_area_4g_district;"

    ],

    "coverage_area_vdc"=>[

        "coverage_area_2g_vdc"=>"
            create materialized view if not exists coverage_area_2g_vdc as
                select st_area(st_transform(st_intersection(vdc.geom,st_union_2g.st_union),32645)),
                vdc.gid from maps_vdc as vdc ,
                st_union_2g order by vdc.gid WITH NO DATA;
            refresh materialized view coverage_area_2g_vdc",

        "coverage_area_3g_vdc"=>"
            create materialized view if not exists coverage_area_3g_vdc as
                select st_area(st_transform(st_intersection(vdc.geom,st_union_3g.st_union),32645)),
                vdc.gid from maps_vdc as vdc ,
                st_union_3g order by vdc.gid WITH NO DATA;
            refresh materialized view coverage_area_3g_vdc",

        "coverage_area_4g_vdc"=>"
            create materialized view if not exists coverage_area_4g_vdc as
                select st_area(st_transform(st_intersection(vdc.geom,st_union_4g.st_union),32645)),
                vdc.gid from maps_vdc as vdc ,
                st_union_4g order by vdc.gid WITH NO DATA;
            refresh materialized view coverage_area_4g_vdc",

    ],
    "st_union"=>[

        "st_union_2g_query"=>"
            create materialized view if not exists st_union_2g as
                With A AS (select c.geom from coverage_data_mv as c where upper(type)='2G'),
                    B AS  (select st_subdivide(geom,10000) as geom from A)
                    select st_union(geom) from B WITH NO DATA;
            refresh materialized view st_union_2g",

        "st_union_3g_query"=>"
            create materialized view if not exists st_union_3g as
                With A AS (select c.geom from coverage_data_mv as c where upper(type)='3G'),
                    B AS  (select st_subdivide(geom,10000) as geom from A)
                    select st_union(geom) from B WITH NO DATA;
            refresh materialized view st_union_3g",

        "st_union_4g_query"=>"
            create materialized view if not exists st_union_4g as
                With A AS (select c.geom from coverage_data_mv as c where upper(type)='4G'),
                    B AS  (select st_subdivide(geom,10000) as geom from A)
                    select st_union(geom) from B WITH NO DATA;
            refresh materialized view st_union_4g",

    ],
    "tab_file"=>[

        "drop_and_create_server_local"=>"
            drop server if exists tabfileserver cascade;
            create server tabfileserver
            foreign data wrapper ogr_fdw
            options (datasource 'e:/NTA/tabfiles', format 'mapInfo File');",

        "drop_and_create_server_devserver"=>"
            drop server if exists tabfileserver cascade;
            create server tabfileserver
            foreign data wrapper ogr_fdw
            options (datasource '/var/www/dev/tabfiles', format 'mapInfo File');",

        "drop_and_create_server_mainserver"=>"
            drop server if exists tabfileserver cascade;
            create server tabfileserver
            foreign data wrapper ogr_fdw
            options (datasource '/var/www/tabfiles', format 'mapInfo File');",

        "drop_and_create_schema"=>"
            DROP SCHEMA IF EXISTS tabfile_schema CASCADE;
            CREATE SCHEMA tabfile_schema ;",

        "import_tab_file"=>"
            IMPORT FOREIGN SCHEMA ogr_all
            FROM SERVER tabfileserver INTO tabfile_schema;"
    ],
    "coverage_data_populate"=>[
        "create_function"=>"
            CREATE EXTENSION IF NOT EXISTS tablefunc;
            DROP FUNCTION if exists fnc_repopulate_coveragedata(character varying,character varying);
            CREATE OR REPLACE FUNCTION fnc_repopulate_coveragedata(_param_oprcd varchar, _param_type varchar)
                RETURNS boolean
                LANGUAGE plpgsql
                AS $$
                DECLARE
                    exists boolean;
                    tablename VARCHAR(50) := _param_oprcd || '_' || _param_type || '_' || 'coverage';
                    schemaname VARCHAR(50) := 'tabfile_schema';
                    columngeom VARCHAR(50) := 'geom';
                    
                BEGIN	
                    Execute format('select exists(SELECT * 
                        FROM information_schema.columns 
                        WHERE table_schema=%L and table_name=%L and column_name=%L 
                        ) 
                    ', schemaname, tablename, columngeom) INTO exists;
                    
                    IF exists = 'true' Then
                        Delete from public.coverage_data where oprcd=_param_oprcd and type=_param_type;
                
                        Execute format('INSERT INTO public.coverage_data(oprcd, type, geom) 
                                SELECT %L as oprcd, %L as type, (ST_Dump(ST_force2D(st_transform(geom, 4326)))).geom
                                FROM tabfile_schema.%I
                                ORDER BY oprcd, type
                            ', _param_oprcd, _param_type, tablename);
                
                        RETURN True;
                    ELSEIF exists = 'false' Then
                        RETURN False;
                    Else
                        RETURN False;
                    END IF;
                    
                Return True;
                END $$;",
        

        "create_valid_mview"=>"
            CREATE MATERIALIZED VIEW IF NOT EXISTS coverage_data_mv as
                select gid, oprcd, type 
                    , case
                        when st_isvalid(geom) is true Then 
                            geom
                        when st_isvalid(geom) is false Then 
                            st_makevalid(geom)
                    END as geom
                    , row_num from public.coverage_data
                order by gid
            WITH NO DATA;
            REFRESH MATERIALIZED VIEW coverage_data_mv;"
    ],
    "update_maps_datacount" =>[
        "create_function"=>"DROP FUNCTION if exists fnc_update_mapsdatacount(character varying,character varying);
                CREATE OR REPLACE FUNCTION fnc_update_mapsdatacount(_param_columnname varchar, _param_tablename varchar)
                    RETURNS Boolean
                    LANGUAGE plpgsql
                    AS $$
                    BEGIN				
                        Execute format('
                                UPDATE maps_province SET %I = ( SELECT count(d.*) FROM %I d, maps_province p WHERE st_intersects(p.geom,d.geom) AND p.gid = maps_province.gid );
                        ', _param_columnname, _param_tablename);
                        Execute format('
                                UPDATE maps_district SET %I = ( SELECT count(d.*) FROM %I d, maps_district p WHERE st_intersects(p.geom,d.geom) AND p.gid = maps_district.gid );
                        ', _param_columnname, _param_tablename);
                        Execute format('
                                UPDATE maps_vdc SET %I = ( SELECT count(d.*) FROM %I d, maps_vdc p WHERE st_intersects(p.geom,d.geom) AND p.gid = maps_vdc.gid );
                                ', _param_columnname, _param_tablename);
                        Execute format('
                                UPDATE maps_ward SET %I = ( SELECT count(d.*) FROM %I d, maps_ward p WHERE st_intersects(p.geom,d.geom) AND p.gid = maps_ward.gid );
                        ', _param_columnname, _param_tablename);
                
                    RETURN True;
                    END $$;"
    ]

];
