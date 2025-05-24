<?php

namespace Modules\Projects\Entities;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Areas\Entities\Country;
use Modules\Category\Entities\Category;
use Modules\Core\Traits\ScopesTrait;
use Modules\Donations\Entities\Donation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use Translatable , SoftDeletes , ScopesTrait ,InteractsWithMedia;

    protected $table = 'projects';
    public $timestamps = true;
    protected $fillable = array('country_id', 'status', 'amount_to_collect','type','link');
    protected $with               = [ 'translations' ];
    public $translatedAttributes  = [ 'title','description' ];
    public $translationModel      = ProjectTranslation::class;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function donations()
    {
        return $this->morphToMany(Donation::class , 'donatable');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function getTotalDonationAttribute()
    {
        return ($this->donations()->where('status','paid')->count() ?  $this->donations()->where('status','paid')->sum('donatables.amount') : 0);
    }

}