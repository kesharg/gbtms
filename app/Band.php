<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model {
    //Name of table associated with the model
    protected $table = 'bands';

    //All the fillable data in the database
    protected $fillable =
    [
        'band_code',
        'band_name',
        'band_category',
        'tx_rx_frequency',

    ];
}

