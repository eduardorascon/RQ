<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bull extends Model
{
	public function cattle()
	{
		return $this->hasOne('App\Cattle' , 'id', 'cattle_id');
	}
}