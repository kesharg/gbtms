<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Added LaravelPostgis Implementation
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

class Opticalfiber extends Model {

    //Should contain this to work along with PostGIS
    use PostgisTrait;

    //Name of table associated with the model
    protected $table = 'opticalfibers';

    //defining primary key
    protected  $primaryKey = 'nodeid';

    //as we have something other than an integer in primary key
    public $incrementing = false;

    //All the fillable data in the database
    protected $fillable =
    [
        //Optical Link Information
        
        
        //Optical Fiber Node ID assigned by NTA
        'nodeid',
        //Location Name
        'nodename',
        //Operator Code
        'oprcd',
        //Province Name
        'province',
        //District Name
        'district',
        //VDC name
        'vdc',
        //Ward Name
        'ward',
        //Street Name
        'strtname',
        //Latitude
        'lat',
        //Longitude
        'long',
        //Geometry i.e. point representation of microwave station
        'geom'
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
