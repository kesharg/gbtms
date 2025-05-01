<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Added LaravelPostgis Implementation
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;
class Wireless extends Model
{
//Should contain this to work along with PostGIS
use PostgisTrait;

//Name of table associated with the model
// protected $table = 'wirelesses';

//All the fillable data in the database
protected $fillable =
[
    //Wireless Information

    //Wireless Site ID assigned by NTA
    'wrlstid',
    //Operator Code assigned by NTA
    'oprcd',
    //Site Id assigned by operator
    'oprsiteid',
    //Site name
    'oprsitename',

    //District
    'district',
    //Municipality/ Rural Municipality
    'vdc',
    //Ward number
    'ward',

    //Street Name
    'strtname',
    //Lattitude
    'lat',
    //Longitude
    'long',

    //Radio Model
    'radiomodel',
    //Antenna height above mean sea level(m)
    'anthmsl',
    //Province
    'province',
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
