<?php

namespace Modules\Families\Entities;

use Illuminate\Database\Eloquent\Model;

class FamilyFoodBasket extends Model 
{

    protected $table = 'family_food_basket';
    public $timestamps = true;
    protected $fillable = array('quantity', 'family_id', 'food_basket_id');

}