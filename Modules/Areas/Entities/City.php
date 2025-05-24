<?php

namespace Modules\Areas\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;

class City extends Model 
{
    use Translatable , SoftDeletes , ScopesTrait;

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable 		  = [ 'status' ,'governorate_id'];
    protected $with               = [ 'translations' ];
    public $translatedAttributes  = [ 'title' ];
    public $translationModel      = CityTranslation::class;

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class,'governorate_id');
    }

}