<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'tokens';
    public $timestamps = true;
    //protected $guarded = [];
    protected $fillable = array('tokenable_id', 'tokenable_type', 'token', 'type');
    protected $casts = ['created_at' => 'datetime:Y-m-d H:m:s', 'updated_at' => 'datetime:Y-m-d H:m:s'];

    public function tokenable()
    {
        return $this->morphTo();
    }
}
