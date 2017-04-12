<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
//    protected $timestamp = 'birthday';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'organization',
        'birthday',
        'is_friend',
    ];


    public function user()
    {
        return  $this->belongsTo('App\User');
    }
}
