<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coveragedata extends Model {
    //Name of table associated with the model
    protected $table = 'coverage_data';

    //All the fillable data in the database
    protected $fillable = [
        'oprcd',
        'type',
        'geom'
    ];
}
