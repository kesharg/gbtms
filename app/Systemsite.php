<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//Added LaravelPostgis Implementation
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

class Systemsite extends Model {
    //Should contain this to work along with PostGIS
    use PostgisTrait;

    //Name of table associated with the model
     protected $table = 'systemsites';

    //defining primary key
    protected  $primaryKey = 'syssiteid';

    //as we have something other than an integer in primary key
    public $incrementing = false;

    //All the fillable data in the database
    protected $fillable = [
        //System site id by nta
        'syssiteid',

        //Operator Code
        'oprcd',

        //Name
        'oprsitename',

        //Site Id Assigned by operator
        'oprsiteid',

        //Latitude
        'lat',

        //Longitude
        'long',

        //Province
        'province',

        //District
        'district',

        //Municipality/ Rural Municipality
        'vdc',

        //WARD NUMBER
        'ward',

        //Street Name
        'strtname',

        //Antenna height mean sea level
        'anthtmsl',

        //Antenna height above ground level
        'anthtgl',

        //Antenna Base Ground/rooftop
        'antbase',

        //Antenna Location
        'antloc',

        //Geometry i.e. point representation of microwave station
        'geom',
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
        ]
    ];
}
