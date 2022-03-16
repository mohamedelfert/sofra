<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{

    protected $table = 'item_order';
    public $timestamps = true;
    protected $guarded = [];
//    protected $fillable = array('item_id', 'order_id', 'price', 'quantity', 'notes');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

}
