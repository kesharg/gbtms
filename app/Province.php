<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model {
    //Name of table associated with the model
    protected $table = 'provinces';

    //All the fillable data in the database
    protected $fillable =
    [
        'state_code',
        'province'
    ];
}
