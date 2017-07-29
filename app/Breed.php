<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
	protected $table = 'breeds';
	public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
