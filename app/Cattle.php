<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cattle extends Model
{
	protected $table = 'cattle';

    public function breed()
    {
    	return $this->hasOne('App\Breed', 'id', 'breed_id');
    }

    /*public function weightLog()
    {
    	return $this->hasMany('App\WeightLog');
    }*/
}