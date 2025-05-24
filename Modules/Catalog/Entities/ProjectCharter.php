<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\ScopesTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProjectCharter extends Model implements HasMedia
{
    use ScopesTrait ,InteractsWithMedia,HasTranslations;

    public $timestamps = true;
    protected $table = 'project_charters';
    protected $fillable = ['title','btn_title','description','status'];
    public $translatable = ['title','btn_title','description'];
}