<?php

namespace Modules\Donations\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;

class ItemType extends Model 
{
    use Translatable , SoftDeletes , ScopesTrait ;

    protected $table = 'item_types';
    public $timestamps = true;
    protected $fillable = array('status');
    protected $with               = [ 'translations' ];
    public $translatedAttributes  = ['title'];
    public $translationModel      = ItemTypeTranslation::class;

    public function items()
    {
        return $this->hasMany(DonateResourceItem::class);
    }

}