<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $timestamps = true;
    protected $table = 'categories';
    protected $guarded = [];
//    protected $fillable = array('name');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function restaurant()
    {
        return $this->belongsToMany('App\Models\Restaurant');
    }

}
