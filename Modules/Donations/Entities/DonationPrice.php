<?php

namespace Modules\Donations\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Baskets\Entities\FoodBasket;
use Modules\Core\Traits\ScopesTrait;
use Modules\Projects\Entities\Project;

class DonationPrice extends Model
{
    use ScopesTrait;
    protected $table = 'donation_prices';
    public $timestamps = true;
    protected $fillable = array('price','sort','status');
}