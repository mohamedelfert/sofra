<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $table = 'regions';
    public $timestamps = true;
    protected $guarded = [];
//    protected $fillable = array('name', 'city_id');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function restaurants()
    {
        return $this->hasMany('App\Models\Restaurant');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

}
