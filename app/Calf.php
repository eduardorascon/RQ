<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calf extends Model
{
	protected $table = 'calves';

    public function cattle()
	{
		return $this->hasOne('App\Cattle', 'id', 'cattle_id');
	}

	public function mother()
	{
		return $this->belongsTo('App\Cow', 'cow_id', 'id');
	}
}
