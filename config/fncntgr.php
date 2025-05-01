<?php
return [

    "fnctgr_tbl_vsats" => [
        "fnc_tbl_vsats" => "
                CREATE OR REPLACE FUNCTION public.fnc_set_no_of_vsat()
                        RETURNS trigger
                        LANGUAGE 'plpgsql'
                AS $$
                BEGIN
                        CASE TG_OP
                                WHEN 'INSERT' THEN            -- single quotes
                                        UPDATE maps_province AS p SET no_of_vsat = p.no_of_vsat + 1 WHERE st_intersects(p.geom,NEW.geom); 
                                        UPDATE maps_district AS d SET no_of_vsat = d.no_of_vsat + 1 WHERE st_intersects(d.geom,NEW.geom);
                                        UPDATE maps_vdc AS v SET no_of_vsat = v.no_of_vsat + 1 WHERE st_intersects(v.geom,NEW.geom);
                                        UPDATE maps_ward AS w SET no_of_vsat = w.no_of_vsat + 1 WHERE st_intersects(w.geom,NEW.geom);
                                WHEN 'DELETE' THEN
                                        UPDATE maps_province AS p SET no_of_vsat = p.no_of_vsat - 1 WHERE st_intersects(p.geom,OLD.geom) AND p.no_of_vsat > 0;
                                        UPDATE maps_district AS d SET no_of_vsat = d.no_of_vsat - 1 WHERE st_intersects(d.geom,OLD.geom) AND d.no_of_vsat > 0;
                                        UPDATE maps_vdc AS v SET no_of_vsat = v.no_of_vsat - 1 WHERE st_intersects(v.geom,OLD.geom) AND v.no_of_vsat > 0;
                                        UPDATE maps_ward AS w SET no_of_vsat = w.no_of_vsat - 1 WHERE st_intersects(w.geom,OLD.geom) AND w.no_of_vsat > 0;
                                ELSE
                                        RAISE EXCEPTION 'Unexpected TG_OP:  Should not occur!';
                        END CASE;
                RETURN NULL;
                END;
                $$;",

        "tgr_tbl_vsats" =>"
                DROP TRIGGER if exists tgr_set_no_of_vsat ON public.vsats;
                CREATE TRIGGER tgr_set_no_of_vsat
                AFTER INSERT OR DELETE
                ON public.vsats
                FOR EACH ROW
                EXECUTE PROCEDURE fnc_set_no_of_vsat();",

        "fnctgr_drop_tbl_vsats" => "
                DROP TRIGGER if exists tgr_set_no_of_vsat ON public.vsats;
                DROP FUNCTION if exists public.fnc_set_no_of_vsat();"
    ],

    "fnctgr_tbl_bts" => [
        "fnc_tbl_bts" => "
                CREATE OR REPLACE FUNCTION public.fnc_set_no_of_bts()
                    RETURNS trigger
                    LANGUAGE 'plpgsql'
                AS $$
                BEGIN
                        CASE TG_OP
                                WHEN 'INSERT' THEN            -- single quotes
                                        UPDATE maps_province AS p SET no_of_bts = p.no_of_bts + 1 WHERE st_intersects(p.geom,NEW.geom); 
                                        UPDATE maps_district AS d SET no_of_bts = d.no_of_bts + 1 WHERE st_intersects(d.geom,NEW.geom);
                                        UPDATE maps_vdc AS v SET no_of_bts = v.no_of_bts + 1 WHERE st_intersects(v.geom,NEW.geom);
                                        UPDATE maps_ward AS w SET no_of_bts = w.no_of_bts + 1 WHERE st_intersects(w.geom,NEW.geom);
                                WHEN 'DELETE' THEN
                                        UPDATE maps_province AS p SET no_of_bts = p.no_of_bts - 1 WHERE st_intersects(p.geom,OLD.geom) AND p.no_of_bts > 0;
                                        UPDATE maps_district AS d SET no_of_bts = d.no_of_bts - 1 WHERE st_intersects(d.geom,OLD.geom) AND d.no_of_bts > 0;
                                        UPDATE maps_vdc AS v SET no_of_bts = v.no_of_bts - 1 WHERE st_intersects(v.geom,OLD.geom) AND v.no_of_bts > 0;
                                        UPDATE maps_ward AS w SET no_of_bts = w.no_of_bts - 1 WHERE st_intersects(w.geom,OLD.geom) AND w.no_of_bts > 0;
                                ELSE
                                        RAISE EXCEPTION 'Unexpected TG_OP: Should not occur!';
                        END CASE;
                RETURN NULL;
                END;
                $$;",

        "tgr_tbl_bts" =>"
                DROP TRIGGER if exists tgr_set_no_of_bts ON public.systemsites;
                CREATE TRIGGER tgr_set_no_of_bts
                AFTER INSERT OR DELETE 
                ON public.systemsites
                FOR EACH ROW
                EXECUTE PROCEDURE public.fnc_set_no_of_bts();",

        "fnctgr_drop_tbl_bts" => "
                DROP TRIGGER if exists tgr_set_no_of_bts ON public.systemsites;
                DROP FUNCTION if exists public.fnc_set_no_of_bts();"
    ],

    "fnctgr_tbl_microwavestation" => [
        "fnc_tbl_microwavestation" => "
                CREATE OR REPLACE FUNCTION public.fnc_set_no_of_microwavestation()
                    RETURNS trigger
                    LANGUAGE 'plpgsql'
                AS $$
                BEGIN
                        CASE TG_OP
                                WHEN 'INSERT' THEN            -- single quotes
                                        UPDATE maps_province AS p SET no_of_microwavestation = p.no_of_microwavestation + 1 WHERE st_intersects(p.geom,NEW.geom); 
                                        UPDATE maps_district AS d SET no_of_microwavestation = d.no_of_microwavestation + 1 WHERE st_intersects(d.geom,NEW.geom);
                                        UPDATE maps_vdc AS v SET no_of_microwavestation = v.no_of_microwavestation + 1 WHERE st_intersects(v.geom,NEW.geom);
                                        UPDATE maps_ward AS w SET no_of_microwavestation = w.no_of_microwavestation + 1 WHERE st_intersects(w.geom,NEW.geom);
                                WHEN 'DELETE' THEN
                                        UPDATE maps_province AS p SET no_of_microwavestation = p.no_of_microwavestation - 1 WHERE st_intersects(p.geom,OLD.geom) AND p.no_of_microwavestation > 0;
                                        UPDATE maps_district AS d SET no_of_microwavestation = d.no_of_microwavestation - 1 WHERE st_intersects(d.geom,OLD.geom) AND d.no_of_microwavestation > 0;
                                        UPDATE maps_vdc AS v SET no_of_microwavestation = v.no_of_microwavestation - 1 WHERE st_intersects(v.geom,OLD.geom) AND v.no_of_microwavestation > 0;
                                        UPDATE maps_ward AS w SET no_of_microwavestation = w.no_of_microwavestation - 1 WHERE st_intersects(w.geom,OLD.geom) AND w.no_of_microwavestation > 0;
                                ELSE
                                        RAISE EXCEPTION 'Unexpected TG_OP:  Should not occur!';
                        END CASE;
                RETURN NULL;
                END;
                $$;",

        "tgr_tbl_microwavestation" =>"
                DROP TRIGGER if exists tgr_set_no_of_microwavestation ON public.microwaves;
                CREATE TRIGGER tgr_set_no_of_microwavestation
                AFTER INSERT OR DELETE 
                ON public.microwaves
                FOR EACH ROW
                EXECUTE PROCEDURE public.fnc_set_no_of_microwavestation();",

        "fnctgr_drop_tbl_microwavestation" => "
                DROP TRIGGER if exists tgr_set_no_of_microwavestation ON public.microwaves;
                DROP FUNCTION if exists public.fnc_set_no_of_microwavestation();"
    ],

    "fnctgr_tbl_pstn" => [
        "fnc_tbl_pstn" => "
                CREATE OR REPLACE FUNCTION public.fnc_set_no_of_pstn()
                    RETURNS trigger
                    LANGUAGE 'plpgsql'
                AS $$
                BEGIN
                        CASE TG_OP
                                WHEN 'INSERT' THEN            -- single quotes
                                        UPDATE maps_province AS p SET no_of_pstn = p.no_of_pstn + 1 WHERE st_intersects(p.geom,NEW.geom); 
                                        UPDATE maps_district AS d SET no_of_pstn = d.no_of_pstn + 1 WHERE st_intersects(d.geom,NEW.geom);
                                        UPDATE maps_vdc AS v SET no_of_pstn = v.no_of_pstn + 1 WHERE st_intersects(v.geom,NEW.geom);
                                        UPDATE maps_ward AS w SET no_of_pstn = w.no_of_pstn + 1 WHERE st_intersects(w.geom,NEW.geom);
                                WHEN 'DELETE' THEN
                                        UPDATE maps_province AS p SET no_of_pstn = p.no_of_pstn - 1 WHERE st_intersects(p.geom,OLD.geom) AND p.no_of_pstn > 0;
                                        UPDATE maps_district AS d SET no_of_pstn = d.no_of_pstn - 1 WHERE st_intersects(d.geom,OLD.geom) AND d.no_of_pstn > 0;
                                        UPDATE maps_vdc AS v SET no_of_pstn = v.no_of_pstn - 1 WHERE st_intersects(v.geom,OLD.geom) AND v.no_of_pstn > 0;
                                        UPDATE maps_ward AS w SET no_of_pstn = w.no_of_pstn - 1 WHERE st_intersects(w.geom,OLD.geom) AND w.no_of_pstn > 0;
                                ELSE
                                        RAISE EXCEPTION 'Unexpected TG_OP:  Should not occur!';
                        END CASE;
                RETURN NULL;
                END;
                $$;",

        "tgr_tbl_pstn" =>"
                DROP TRIGGER if exists tgr_set_no_of_pstn ON public.p_s_t_n_s;
                CREATE TRIGGER tgr_set_no_of_pstn
                AFTER INSERT OR DELETE 
                ON public.p_s_t_n_s
                FOR EACH ROW
                EXECUTE PROCEDURE public.fnc_set_no_of_pstn();",

        "fnctgr_drop_tbl_pstn" => "
                DROP TRIGGER if exists tgr_set_no_of_pstn ON public.p_s_t_n_s;
                DROP FUNCTION if exists public.fnc_set_no_of_pstn();"
    ],

    "fnctgr_tbl_wireless" => [
        "fnc_tbl_wireless" => "
                CREATE OR REPLACE FUNCTION public.fnc_set_no_of_wireless()
                    RETURNS trigger
                    LANGUAGE 'plpgsql'
                AS $$
                BEGIN
                        CASE TG_OP
                                WHEN 'INSERT' THEN            -- single quotes
                                        UPDATE maps_province AS p SET no_of_wireless = p.no_of_wireless + 1 WHERE st_intersects(p.geom,NEW.geom); 
                                        UPDATE maps_district AS d SET no_of_wireless = d.no_of_wireless + 1 WHERE st_intersects(d.geom,NEW.geom);
                                        UPDATE maps_vdc AS v SET no_of_wireless = v.no_of_wireless + 1 WHERE st_intersects(v.geom,NEW.geom);
                                        UPDATE maps_ward AS w SET no_of_wireless = w.no_of_wireless + 1 WHERE st_intersects(w.geom,NEW.geom);
                                WHEN 'DELETE' THEN
                                        UPDATE maps_province AS p SET no_of_wireless = p.no_of_wireless - 1 WHERE st_intersects(p.geom,OLD.geom) AND p.no_of_wireless > 0;
                                        UPDATE maps_district AS d SET no_of_wireless = d.no_of_wireless - 1 WHERE st_intersects(d.geom,OLD.geom) AND d.no_of_wireless > 0;
                                        UPDATE maps_vdc AS v SET no_of_wireless = v.no_of_wireless - 1 WHERE st_intersects(v.geom,OLD.geom) AND v.no_of_wireless > 0;
                                        UPDATE maps_ward AS w SET no_of_wireless = w.no_of_wireless - 1 WHERE st_intersects(w.geom,OLD.geom) AND w.no_of_wireless > 0;
                                ELSE
                                        RAISE EXCEPTION 'Unexpected TG_OP:  Should not occur!';
                        END CASE;
                RETURN NULL;
                END;
                $$;",

        "tgr_tbl_wireless" =>"
                DROP TRIGGER if exists tgr_set_no_of_wireless ON public.wirelesses;
                CREATE TRIGGER tgr_set_no_of_wireless
                AFTER INSERT OR DELETE 
                ON public.wirelesses
                FOR EACH ROW
                EXECUTE PROCEDURE public.fnc_set_no_of_wireless();",

        "fnctgr_drop_tbl_wireless" => "
                DROP TRIGGER if exists tgr_set_no_of_wireless ON public.wirelesses;
                DROP FUNCTION if exists public.fnc_set_no_of_wireless();"
    ],

    "fnc_update_tbl_allcount" => [
        "fnc_updt_mapsdatacount" => "
                DROP FUNCTION if exists fnc_update_mapsdatacount(character varying,character varying);
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
                    END $$;",
        
        "updt_tbl_vsat" => "select fnc_update_mapsdatacount('no_of_vsat', 'vsats')",
        "updt_tbl_bts" => "select fnc_update_mapsdatacount('no_of_bts', 'systemsites')",
        "updt_tbl_microwavestation" => "select fnc_update_mapsdatacount('no_of_microwavestation', 'microwaves')",
        "updt_tbl_opticalfiber" => "select fnc_update_mapsdatacount('opticalfiber_length','opticalfibers')",
        "updt_tbl_pstn" => "select fnc_update_mapsdatacount('no_of_pstn', 'p_s_t_n_s')",
        "updt_tbl_wireless" => "select fnc_update_mapsdatacount('no_of_wireless', 'wirelesses')",

    ]
];