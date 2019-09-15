<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    const PENDING = 1;
    const CONFIRMED = 2;
    const PAYED = 3;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'amount',
    ];

}
