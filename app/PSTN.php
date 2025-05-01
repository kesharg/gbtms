<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Added LaravelPostgis Implementation
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use MStaack\LaravelPostgis\Geometries\Point;
class PSTN extends Model
{
   //Should contain this to work along with PostGIS
    use PostgisTrait;

   //Name of table associated with the model
    protected $table = 'p_s_t_n_s';

   //All the fillable data in the database
    protected $fillable =
    [
       //PSTN Information

       //Exchange ID assigned by NTA
        'exid',
        //Exchange ID assigned by operator
        'oprexid',
        //Exchange Name
        'exname',
        //Exchange Type
        'extype',

        //Parent Exchange ID
        'prtex',
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
        //Operator code
        'oprcd',
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
