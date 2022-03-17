<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $guarded = [];
//    protected $fillable = array('address', 'notes', 'cost', 'delivery_cost', 'total', 'restaurant_id', 'payment_method_id', 'delivery_at', 'status', 'commission', 'client_delivery_confirm', 'restaurant_delivery_confirm', 'cart');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function payment_method()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Item')->withPivot('price','quantity','notes');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}
