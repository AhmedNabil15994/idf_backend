<?php

namespace Modules\Families\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Areas\Entities\Address;
use Modules\Baskets\Entities\FoodBasket;
use Modules\Charities\Entities\Charity;
use Modules\Core\Traits\Attachmentable;
use Modules\Core\Traits\ScopesTrait;
use Modules\Order\Entities\Order;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Family extends Model implements HasMedia
{
    use SoftDeletes ,ScopesTrait,InteractsWithMedia;

    protected $table = 'families';
    public $timestamps = true;
    protected $fillable = array('members_count','charity_id');

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function members()
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function baskets()
    {
        return $this->belongsToMany(FoodBasket::class)->withPivot('quantity');
    }

    public function charity()
    {
        return $this->belongsTo(Charity::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getHeadInfoAttribute()
    {
        return $this->members()->where('type' , 'leader')->first();
    }

    public function getMembersInfoAttribute()
    {
        $members = $this->members()->where('type' , 'member');
        return $members->count() ? $members->get() : [];
    }

}