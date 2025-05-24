<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;

class ReligionTranslation extends Model 
{

    protected $table = 'religion_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'locale', 'religion_id');

}