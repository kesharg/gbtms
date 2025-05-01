<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opticalfiberlink extends Model
{
    //Name of table associated with the model
    protected $table = 'opticalfiberlinks';

    //defining primary key
    protected  $primaryKey = 'oflinkid';

    //as we have something other than an integer in primary key
    public $incrementing = false;

    //All the fillable data in the database
    protected $fillable =
    [
        //Optical Link Information
        
        //Optical Fiber Node ID assigned by NTA
        'oflinkid',
        //Link ID assigned by Operator
        'oprlinkid',
        //Link Name
        'linkname',
        //Operator Code
        'oprcd',
        //Segment Length
        'length',
        //Origin Node ID
        'orgnodeid',
        //End Node ID
        'endnodeid',
        //Cable Laying Type
        'cabletype',
        //No Of Fibers
        'fibers',
        //Capacity(dB)
        'capacity',
        //Link Status
        'status',
        //store kml path
        'kmlpath',
        //store goem from kml file
        'geom'
    ];
}
