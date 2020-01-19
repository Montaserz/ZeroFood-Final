<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['total', 'status'];
    protected $hidden = ['updated_at'];

    public function meal()
    {
        return $this->belongsTo('App\Meal');
    }
    public function user()
    {
        return $this->belongsTo('App\Meal');
    }
}
