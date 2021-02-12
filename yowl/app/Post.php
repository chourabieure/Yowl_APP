<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id_owner'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','id_owner');
    }
}
