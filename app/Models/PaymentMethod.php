<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{

    protected $table = 'payment_methods';
    public $timestamps = true;
    protected $guarded = [];
//    protected $fillable = array('name');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}
