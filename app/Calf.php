<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calf extends Model
{
    public function cattle()
	{
		return $this->hasOne('App\Cattle' , 'id', 'cattle_id');
	}
}
