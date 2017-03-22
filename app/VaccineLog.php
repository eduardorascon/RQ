<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VaccineLog extends Model
{
    protected $table = 'vaccination_logs';

    public function vaccine()
    {
    	return $this->hasOne('App\Vaccine', 'id', 'vaccine_id');
    }
}
