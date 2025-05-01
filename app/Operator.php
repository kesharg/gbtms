<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model {
    //Name of table associated with the model
    protected $table = 'operators';

    //defining primary key
    protected  $primaryKey = 'operator_code';

    //as we have something other than an integer in primary key
    public $incrementing = false;

    //All the fillable data in the database
    protected $fillable =
    [
        'operator_id',
        'operator_code',
        'operator_name',
        'operator_url',
        'color_code',

    ];
}

