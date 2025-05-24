<?php

namespace Modules\Charities\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Baskets\Entities\FoodBasket;
use Modules\Core\Traits\ScopesTrait;
use Modules\Families\Entities\Family;
use Modules\Order\Entities\Order;
use Modules\User\Entities\User;
use Modules\Volunteers\Entities\Volunteer;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Charity extends Model implements HasMedia
{
    use Translatable , SoftDeletes , ScopesTrait ,InteractsWithMedia;

    protected $table = 'charities';
    public $timestamps = false;
    protected $fillable = array('status', 'address', 'phone', 'whats_app', 'facebook','user_id');
    protected $with               = [ 'translations' ];
    public $translatedAttributes  = [ 'title','description' ];
    public $translationModel      = CharityTranslation::class;

    public function families()
    {
        return $this->hasMany(Family::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class,Family::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function baskets()
    {
        return $this->belongsToMany(FoodBasket::class)->withPivot('quantity');
    }

    public function volunteers() {
        return $this->hasMany(Volunteer::class,'charity_id');
    }
}