<?php

namespace Modules\Areas\Entities;

use Illuminate\Database\Eloquent\Model;

class RegionTranslation extends Model 
{

    protected $table = 'region_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'locale', 'region_id');

}