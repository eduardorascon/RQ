<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{
	protected $table = 'cows';
	public $timestamps = false;

    public function cattle()
	{
		return $this->hasOne('App\Cattle', 'id', 'cattle_id');
	}

	public function offspring()
	{
		return $this->hasMany('App\Calf');
	}

	public function palpationLog()
    {
    	return $this->hasMany('App\PalpationLog');
    }

    public function sale()
	{
		return $this->hasOne('App\CowSale', 'id', 'sale_id');
	}
}
