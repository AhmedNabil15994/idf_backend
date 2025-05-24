<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\ScopesTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Statistics extends Model implements HasMedia
{
    use ScopesTrait ,InteractsWithMedia,HasTranslations;

    public $timestamps = true;
    protected $table = 'statistics';
    protected $fillable = ['title','sub_title','value','status'];
    public $translatable = ['title','sub_title'];
}