<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $guarded = [];
//    protected $fillable = array('title', 'description', 'start_at', 'end_at', 'image', 'restaurant_id', 'status');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}
