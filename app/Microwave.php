<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Added LaravelPostgis Implementation
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

class Microwave extends Model {

    //Should contain this to work along with PostGIS
    use PostgisTrait;

    //Name of table associated with the model
    protected $table = 'microwaves';

    //defining primary key
    protected  $primaryKey = 'mwstncode';

    //as we have something other than an integer in primary key
    public $incrementing = false;

    //All the fillable data in the database
    protected $fillable =
    [
        //Microwave Station Information

        //Microwave Station Code( NCELL-0001 )
        'mwstncode',
        //Operator Code( NCELL )
        'oprcd',
        //Microwave Station Code Assigned By Operator
        'mwstncdopr',
        //Microwave Station Name
        'mwstnname',
        //Province
        'province',
        //District
        'district',
        //Municipality/VDC
        'vdc',
        //Ward Number
        'ward',
        //Street Name
        'strtname',
        //Lattitude
        'lat',
        //Longtitude
        'long',
        //Geometry i.e. point representation of microwave station
        'geom',
        //Province
        'province'
    ];

    //Defines geom is POINT
    protected $postgisFields = [
        'geom'=>Point::class,
    ];

    //By default it is geography so converted geomtype to geometry
    protected $postgisTypes = [
        'geom' => [
            'geomtype' => 'geometry',
            'srid' => 4326
        ]];
    }

