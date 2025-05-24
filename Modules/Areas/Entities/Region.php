<?php

namespace Modules\Areas\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;

class Region extends Model 
{
    use Translatable , SoftDeletes , ScopesTrait;

    protected $table = 'regions';
    public $timestamps = true;
    protected $with               = [ 'translations' ];
    protected $fillable 		  = [ 'status' ,'city_id'];
    public $translatedAttributes  = [ 'title' ];
    public $translationModel      = RegionTranslation::class;

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}