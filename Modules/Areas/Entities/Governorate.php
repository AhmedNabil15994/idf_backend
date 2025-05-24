<?php

namespace Modules\Areas\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;

class Governorate extends Model 
{
    use Translatable , SoftDeletes , ScopesTrait;

    protected $table = 'governorates';
    public $timestamps = true;
    protected $with               = [ 'translations' ];
    protected $fillable 		  = [ 'status' ];
    public $translatedAttributes  = [ 'title' ];
    public $translationModel      = GovernorateTranslation::class;

    public function cities()
    {
        return $this->hasMany(City::class);
    }

}