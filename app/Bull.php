<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bull extends Model
{
	protected $table = 'bulls';
	public $timestamps = false;

	protected $fillable = [
        'cattle_id'
    ];

	public function cattle()
	{
		return $this->hasOne('App\Cattle' , 'id', 'cattle_id');
	}

	public function sale()
	{
		return $this->hasOne('App\BullSale', 'id', 'sale_id');
	}
}