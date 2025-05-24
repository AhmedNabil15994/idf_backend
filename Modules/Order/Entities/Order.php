<?php

namespace Modules\Order\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Baskets\Entities\FoodBasket;
use Modules\Core\Traits\ScopesTrait;
use Modules\Families\Entities\Family;
use Modules\Volunteers\Entities\Volunteer;

class Order extends Model
{
    use SoftDeletes , ScopesTrait ;

    static $status = ['pending','delivered'];
    protected $table = 'orders';
    public $timestamps = true;
        protected $fillable = array('family_id','volunteer_id','period','volunteer_note','status');

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class,'volunteer_id');
    }

    public function baskets()
    {
        return $this->belongsToMany(FoodBasket::class)->withPivot('quantity');
    }

}