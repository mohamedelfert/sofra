<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    public $timestamps = true;
    protected $table = 'cities';
    protected $guarded = [];
//    protected $fillable = array('name');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function regions()
    {
        return $this->hasMany('App\Models\Region');
    }

}
