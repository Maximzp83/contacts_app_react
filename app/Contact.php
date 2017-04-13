<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contact extends Model
{
//    protected $timestamp = 'birthday';
    protected $dates = ['created_at'];
    protected $birthday = ['birthday'];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'organization',
        'birthday',
        'is_friend',
    ];


    public function getCreatedAtAttribute($date) // Мутатор
    {
        return Carbon::parse($date)->format('Y-m-d');
    }


    public function setBirthdayAttribute($date) // Мутатор
    {
        $this->attributes['birthday'] = Carbon::parse($date);
    }

    /**
     *  Returned Birthday Date
     * @param $date
     * @return int|null
     */
    public function getBirthdayAttribute($date) // Мутатор
    {
        if ($date != null) {
            return Carbon::parse($date)->format('Y-m-d');
        }
        return null;
    }


    /**
     *  Returned Age from Birthday
     *
     *
     */
    public function getAgeAttribute($date) // Мутатор
    {
        if ($date != null) {
            return Carbon::parse($date)->diffInYears(Carbon::now());
        }
       return null;
    }

    public function user()
    {
        return  $this->belongsTo('App\User');
    }
}
