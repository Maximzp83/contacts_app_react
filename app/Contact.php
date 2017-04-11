<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'organization/company',
        'birthday',
    ];




    public function user()
    {
        return  $this->belongsTo('App\User');
    }
}
