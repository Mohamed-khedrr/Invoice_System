<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_details extends Model
{
    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
