<?php

namespace Modules\Catalog\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;

class Religion extends Model 
{
    use Translatable , SoftDeletes , ScopesTrait;

    protected $table = 'religions';
    public $timestamps = true;
    protected $with               = [ 'translations' ];
    protected $fillable 		  = [ 'status' ];
    public $translatedAttributes  = [ 'title' ];
    public $translationModel      = ReligionTranslation::class;

    public function familyMember()
    {
        return $this->hasMany('App\Models\FamilyMember');
    }

}