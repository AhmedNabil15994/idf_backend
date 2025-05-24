<?php

namespace Modules\Donations\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemTypeTranslation extends Model 
{

    protected $table = 'item_type_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'locale', 'item_type_id');

}