<?php

namespace Modules\Areas\Entities;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model 
{

    protected $table = 'city_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'locale', 'city_id');

}