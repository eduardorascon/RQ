<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cattle extends Model
{
	protected $table = 'cattle';
    public $timestamps = false;

    protected $fillable = [
        'tag', 'purchase_date', 'birth', 'breed_id', 'control_tag', 'empadre_date'
    ];

    public function breed()
    {
    	return $this->hasOne('App\Breed', 'id', 'breed_id');
    }

    public function owner()
    {
        return $this->hasOne('App\Owner', 'id', 'owner_id');
    }

    public function paddock()
    {
        return $this->hasOne('App\Paddock', 'id', 'paddock_id');
    }

    public function weightLog()
    {
    	return $this->hasMany('App\WeightLog');
    }

    public function currentWeight()
    {
        $currentWeight = $this->hasMany('App\WeightLog')->orderBy('date', 'desc')->first();
        return ($currentWeight["weight"] > 0 ? $currentWeight["weight"] : 0) . ' kgs';
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
        if($this->birth === NULL)
            return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->birth)->formatLocalized('%d/%B/%Y');
    }

    public function getBirthWithFormat2()
    {
        if($this->birth === NULL)
            return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->birth)->formatLocalized('%d/%m/%Y');
    }

    public function getPurchaseDateWithFormat()
    {
        if($this->purchase_date === NULL)
            return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->purchase_date)->formatLocalized('%d/%B/%Y');
    }

    public function getPurchaseDateWithFormat2()
    {
        if($this->purchase_date === NULL)
            return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->purchase_date)->formatLocalized('%d/%m/%Y');
    }
}