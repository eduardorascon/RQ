<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;

class CowView extends Model
{
    use Sortable;

    protected $table = 'cows_view';
	public $timestamps = false;
    public $sortable = ['tag', 'breed_name', 'control_tag', 'empadre_date', 'birth', 'purchase_date', 'sale_date', 'current_weight', 'age_in_months', 'pregnancy_status', 'months_since_last_birth'];

    public function getBirthWithFormat()
    {
        if($this->birth === NULL)
            return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->birth)->formatLocalized('%d/%B/%Y');
    }

    public function getPurchaseDateWithFormat()
    {
        if($this->purchase_date === NULL)
            return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->purchase_date)->formatLocalized('%d/%B/%Y');
    }

    public function getEmpadreDateWithFormat()
    {
        if($this->empadre_date === NULL)
            return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->empadre_date)->formatLocalized('%d/%B/%Y');
    }

    public function getSaleDateWithFormat()
    {
        if($this->sale_date === NULL)
            return null;

        setLocale(LC_TIME, 'es_MX.UTF-8', 'Spanish_Spain.1252');
        return Carbon::parse($this->sale_date)->formatLocalized('%d/%B/%Y');
    }
}
