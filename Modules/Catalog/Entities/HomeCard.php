<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\ScopesTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HomeCard extends Model implements HasMedia
{
    use ScopesTrait ,InteractsWithMedia,HasTranslations;

    public $timestamps = true;
    protected $table = 'home_cards';
    protected $fillable = ['title','sub_title','status','color','link'];
    public $translatable = ['title','sub_title'];
}