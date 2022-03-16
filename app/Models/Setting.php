<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $guarded = [];
//    protected $fillable = array('commission_text', 'about_app', 'phone', 'email', 'commission', 'fb_url', 'tw_url', 'insta_url', 'android_url', 'ios_url', 'bank_account');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

}
