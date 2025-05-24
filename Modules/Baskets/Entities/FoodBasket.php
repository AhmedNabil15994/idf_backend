<?php

namespace Modules\Baskets\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Attachmentable;
use Modules\Core\Traits\ScopesTrait;
use Modules\Donations\Entities\Donation;
use Modules\Order\Entities\Order;
use Modules\Families\Entities\Family;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FoodBasket extends Model  implements HasMedia
{
    use Translatable , SoftDeletes , ScopesTrait , Attachmentable , InteractsWithMedia;

    protected $table = 'food_baskets';
    public $timestamps = true;
    protected $fillable = array('status', 'price', 'quantity');
    protected $with               = [ 'translations' ];
    public $translatedAttributes  = [ 'title','description' ];
    public $translationModel      = FoodBasketTranslation::class;

    public function families()
    {
        return $this->belongsToMany(Family::class)->withPivot('quantity');
    }

    public function donations()
    {
        return $this->morphToMany(Donation::class , 'donatable');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}