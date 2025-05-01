<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opticalfiberlinkplan extends Model
{
    //Name of table associated with the model
    protected $table = 'opticalfiberlinkplans';

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
        //Link Name
        'linkname',
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
        //store kml path
        'kmlpath',
        //store goem from kml file
        'geom'
    ];
}
