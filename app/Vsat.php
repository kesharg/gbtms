<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//Added LaravelPostgis Implementation
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

class Vsat extends Model {

    //Should contain this to work along with PostGIS
    use PostgisTrait;

    //Name of table associated with the model
    protected $table = 'vsats';

    //defining primary key
    protected  $primaryKey = 'vsatid';

    //as we have something other than an integer in primary key
    public $incrementing = false;

    //All the fillable data in the database
    protected $fillable =
    [
        //Vsat Information

        //VSAT Station ID assigned by NTA
        'vsatid',
        //Operator Code
        'oprcd',
        //VSAT Station ID assigned by Operator
        'oprvsatid',
        //VSAT Station Name
        'vsatstnname',

        //District
        'district',
        //Municipality/ Rural Municipality
        'vdc',
        //WARD NUMBER
        'ward',
        //Street Name
        'strtname',

        //Lattitude
        'lat',
        //Longitude
        'long',
        //Geometry i.e. point representation of microwave station
        'geom',

        //Operated from
        'oprfrom',
        //Operated to
        'oprto',
        //Purpose of Operation
        'purpose',

        //Transmission Frequency in MHz
        'uplink',
        //Receiving Frequecny in MHz
        'downlink',
        //Modulation Technique
        'modtechq',
        //VSAT / EARTH STATION
        'stationtype',

        //Uplink Data Rate
        'updatart',
        //Down Link Data Rate
        'dwndatart',

        //Transmitted Power( dBm )
        'transpwr',
        //Radio Model
        'radiomodel',
        //Antenna Diameter
        'antdia',
        //Antenna height MSL [m]
        'anthtmsl',

        //Status of the system
        'status',
        //Band Code
        'band_code',

        //Bandwidth
        'band_width',
        //Name of Satellite
        'namesat',
        //Satellite Orientation
        'satorient',
        //Rural/Urban
        'rurubr',
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
