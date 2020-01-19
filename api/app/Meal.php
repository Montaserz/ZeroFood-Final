<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = ['name', 'price', 'info', 'picture'];
    protected $hidden = ["created_at", "updated_at"];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
