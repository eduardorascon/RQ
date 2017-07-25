<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paddock extends Model
{
	protected $table = 'paddocks';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
