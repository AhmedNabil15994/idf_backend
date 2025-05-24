<?php

namespace Modules\Areas\Entities;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model 
{

    protected $table = 'country_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'locale', 'country_id');

}