<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public $timestamps = true;
    protected $table = 'items';
    protected $guarded = [];
//    protected $fillable = array('name', 'description', 'price', 'offer_price', 'preparing_time', 'image', 'restaurant_id', 'status');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

}
