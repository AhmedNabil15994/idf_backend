<?php

namespace Modules\Areas\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;

class Country extends Model 
{
    use Translatable , SoftDeletes , ScopesTrait;

    protected $table = 'countries';
    public $timestamps = true;
    protected $with               = [ 'translations' ];
    protected $fillable 		  = [ 'status' ];
    public $translatedAttributes  = [ 'title' ];
    public $translationModel      = CountryTranslation::class;

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

}