<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infrastructurecode extends Model {
    //Name of table associated with the model
    protected $table = 'infrastructurecodes';

    //All the fillable data in the database
    protected $fillable =
    [
        'infrastructure_name',
        'infrastructure_code',
    ];
}

