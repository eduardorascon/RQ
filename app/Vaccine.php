<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
	protected $table = 'vaccines';
	public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
