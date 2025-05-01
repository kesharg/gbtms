<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Added LaravelPostgis Implementation
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;

class Microwavestation extends Model {

    //Should contain this to work along with PostGIS
    use PostgisTrait;

    //Name of table associated with the model
    protected $table = 'microwavestations';

    //defining primary key
    protected  $primaryKey = 'mwlinkid';

    //as we have something other than an integer in primary key
    public $incrementing = false;

    protected $fillable =
    [
        // Microwave Link information

        //Link ID assigned by NTA
        'mwlinkid',
        //Operator Code
        'oprcd',
        //Link ID assigned by Operator
        'oprlinkid',
        //Link Name assigned by Operator
        'linkname',
        //DISTANCE
        'distance',
        //BANDWIDTH
        'bdwidth',
        //Polarization
        'polariz',
        //Protection Type
        'protection',
        //Date approved
        'dateapprove',
        //Microwave Station Name
        'mwstnname',
        //Operation Date
        'dateoprt',
        //Status
        'status',

        //Station one info

        //microwave Station Code A
        'mwstncodea',
        //Azimuth in Degree
        'azimutha',
        //Model of Radios
        'radiomodela',
        //Transmission Frequency in MHz
        'txfrqa',
        //Receiving Frequecny in MHz
        'rxfrqa',
        //Antenna Diameter in Meter
        'antdiaa',
        //Antenna gain( dB )
        'antgaina',
        //Transmitted Power( dBm )
        'txpowera',
        //Receiver Power( dBm )
        'rxpowera',
        //Antenna height above the ground Level  [m]
        'anthtgla',

        //Station two info

        //Microwave Station Code B
        'mwstncodeb',
        //Azimuth in Degree
        'azimuthb',
        //Model of Radios
        'radiomodelb',
        //Transmission Frequency in MHz
        'txfrqb',
        //Receiving Frequecny in MHz
        'rxfrqb',
        //Antenna Diameter in Meter
        'antdiab',
        //Antenna gain( dB )
        'antgainb',
        //Transmitted Power( dBm )
        'txpowerb',
        //Transmitted Power( dBm )
        'rxpowerb',
        //Antenna height above the ground Level  [m]
        'anthtglb',
        //Band Code
        'band_code',
        //Geometry i.e. point representation of microwave station
        'geom'
    ];

    //Defines geom is POINT
    protected $postgisFields = [
        'geom'=>LineString::class,
    ];

    //By default it is geography so converted geomtype to geometry
    protected $postgisTypes = [
        'geom' => [
            'geomtype' => 'geometry',
            'srid' => 4326
        ]];
    }
