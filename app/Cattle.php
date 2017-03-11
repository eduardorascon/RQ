<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cattle extends Model
{
    public function breed()
    {
    	return $this->hasOne('App\Breed');
    }
}
