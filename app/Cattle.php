<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cattle extends Model
{
	protected $table = 'cattle';
    public $timestamps = false;

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

    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }

    public function getBirthWithFormat()
    {
        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->birth)->formatLocalized('%d/%B/%Y');
    }

    public function getPurchaseDateWithFormat()
    {
        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->purchase_date)->formatLocalized('%d/%B/%Y');
    }
}