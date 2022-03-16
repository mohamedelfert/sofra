<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $table = 'transactions';
    public $timestamps = true;
    protected $guarded = [];
//    protected $fillable = array('amount', 'notes', 'restaurant_id');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}
