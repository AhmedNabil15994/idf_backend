<?php

namespace Modules\Charities\Entities;

use Illuminate\Database\Eloquent\Model;

class CharityTranslation extends Model 
{

    protected $table = 'charity_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'description', 'locale', 'charity_id');

}