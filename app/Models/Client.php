<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public $timestamps = true;
    protected $table = 'clients';
    protected $guarded = [];
//    protected $fillable = array('name', 'email', 'phone', 'password', 'region_id', 'address', 'image', 'api_token', 'pin_code', 'is_active');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function review()
    {
        return $this->belongsTo('App\Models\Review');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

}
