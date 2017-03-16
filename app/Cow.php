<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{
    public function cattle()
	{
		return $this->hasOne('App\Cattle', 'id', 'cattle_id');
	}

	public function offspring()
	{
		return $this->hasMany('App\Calf');
	}
}
