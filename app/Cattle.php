<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cattle extends Model
{
	protected $table = 'cattle';

    public function breed()
    {
    	return $this->hasOne('App\Breed', 'id', 'breed_id');
    }

    public function weightLog()
    {
    	return $this->hasMany('App\WeightLog');
    }

    public function vaccinationLog()
    {
    	return $this->hasMany('App\VaccineLog');
    }

    public function getBirthAttribute($value)
    {
        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($value)->formatLocalized('%d/%B/%Y');
    }

    public function getPurchaseDateAttribute($value)
    {
        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($value)->formatLocalized('%d/%B/%Y');
    }
}