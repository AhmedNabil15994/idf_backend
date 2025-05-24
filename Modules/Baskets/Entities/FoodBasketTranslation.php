<?php

namespace Modules\Baskets\Entities;

use Illuminate\Database\Eloquent\Model;

class FoodBasketTranslation extends Model 
{

    protected $table = 'food_basket_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'description', 'locale', 'food_basket_id');

}