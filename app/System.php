<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class System extends Model {

    //Name of table associated with the model
    protected $table = 'systems';

    //defining primary key
    protected  $primaryKey = 'deviceid';

    //as we have something other than an integer in primary key
    public $incrementing = false;

    //All the fillable data in the database
    protected $fillable = [
        //Operator Code( NCELL )
        'oprcd',

        //BTS ID assigned by NTA
        'syssiteid',

        //ID assigned by NTA for device
        'deviceid',

        //Azimuth
        'azimuth',

        //Tilt
        'tilt',

        //Antenna Gain( db )
        'antgain',

        //Transmitted Power( dBm )
        'transpwr',

        //Sectors
        'sector',

        //Channel Number ( Tx )
        'txchanls',

        //Channel Number ( Rx )
        'rxchanls',

        //Carrier Bandwidth ( MHz )
        'carbdwidth',

        //Radio Model
        'radiomodel',

        //Operation Date
        'oprdate',

        //Polarization
        'polariz',

        //Status of the system
        'status',

        //Band
//        'band_code',

        //Type
        'type',

    ];
}
