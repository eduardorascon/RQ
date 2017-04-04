<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CalfSale extends Model
{
    protected $table = 'calves_sales';
    public $timestamps = false;

    public function client()
    {
    	return $this->belongsTo('App\Client', 'client_id', 'id');
    }

    public function getSaleDateAttribute($value)
    {
        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($value)->formatLocalized('%d/%B/%Y');
    }
}
