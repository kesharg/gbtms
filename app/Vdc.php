<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vdc extends Model {
    //Name of table associated with the model
    protected $table = 'vdcs';

    //All the fillable data in the database
    protected $fillable =
    [
        'state_code',
        'district',
        'vdc'
    ];
}
