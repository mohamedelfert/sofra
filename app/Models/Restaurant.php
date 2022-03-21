<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Restaurant extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public $timestamps = true;
    protected $table = 'restaurants';
    protected $guarded = [];
//    protected $fillable = array('name', 'email', 'phone', 'second_phone', 'password', 'region_id', 'minimum_order', 'delivery_fee', 'whatsapp', 'image', 'status', 'is_active', 'api_token', 'pin_code');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_restaurant', 'restaurant_id', 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

}
