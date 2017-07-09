<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CowSale extends Model
{
    protected $table = 'cows_sales';
    public $timestamps = false;

    public function client()
    {
    	return $this->belongsTo('App\Client', 'client_id', 'id');
    }

    public function getSaleDateWithFormat()
    {
        if($this->sale_date === NULL)
            return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->sale_date)->formatLocalized('%d/%B/%Y');
    }

    public function getSaleDateWithFormat2()
    {
        if($this->sale_date === NULL)
            return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->sale_date)->formatLocalized('%d/%m/%Y');
    }
}
