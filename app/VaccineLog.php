<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VaccineLog extends Model
{
    protected $table = 'vaccination_logs';

    public function vaccine()
    {
    	return $this->hasOne('App\Vaccine', 'id', 'vaccine_id');
    }

    public function getDateAttribute($value)
    {
        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($value)->formatLocalized('%d/%B/%Y');
    }
}
