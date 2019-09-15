<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardPayment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_id', 'order_id',
    ];
}
