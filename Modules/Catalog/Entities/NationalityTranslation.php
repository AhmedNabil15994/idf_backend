<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;

class NationalityTranslation extends Model 
{

    protected $table = 'nationality_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'locale');

}