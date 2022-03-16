<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    public $timestamps = true;
    protected $table = 'contacts';
    protected $guarded = [];
//    protected $fillable = array('name', 'email', 'phone', 'message', 'type');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

}
