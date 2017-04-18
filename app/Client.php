<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $table = 'clients';
	public $timestamps = false;

    protected $fillable = [
        'first_name', 'last_name', 'address', 'company', 'phone'
    ];

    public function purchases()
    {
    	return $this->hasMany('App\CalfSale');
    }
}
