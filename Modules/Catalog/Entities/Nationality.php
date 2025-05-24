<?php

namespace Modules\Catalog\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;

class Nationality extends Model 
{
    use Translatable , SoftDeletes , ScopesTrait;

    protected $table = 'nationalities';
    public $timestamps = true;
    protected $with               = [ 'translations' ];
    protected $fillable 		  = [ 'status' ];
    public $translatedAttributes  = [ 'title' ];
    public $translationModel      = NationalityTranslation::class;

    public function familyMember()
    {
        return $this->hasMany('App\Models\FamilyMember');
    }

}