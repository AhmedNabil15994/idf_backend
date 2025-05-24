<?php

namespace Modules\Areas\Entities;

use Illuminate\Database\Eloquent\Model;

class GovernorateTranslation extends Model 
{

    protected $table = 'governorate_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'locale', 'governorate_id');

}