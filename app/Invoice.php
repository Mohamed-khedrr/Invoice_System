<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
