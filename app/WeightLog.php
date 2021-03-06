<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WeightLog extends Model
{
	protected $table = 'weight_logs';
	public $timestamps = false;

    public function getDateAttributeWithFormat()
    {
    	if($this->date === NULL)
    		return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->date)->formatLocalized('%d/%B/%Y');
    }
}
