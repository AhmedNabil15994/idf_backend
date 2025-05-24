<?php

namespace Modules\Category\Entities;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ScopesTrait;
use Illuminate\Support\Facades\Artisan;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use Translatable, SoftDeletes, ScopesTrait, InteractsWithMedia;

    protected $with = ['translations', 'children'];
    protected $fillable = ['status', 'type', 'image', 'category_id'];
    public $translatedAttributes = ['title'];
    public $translationModel = CategoryTranslation::class;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    public function scopeSubCategories($query, $parent = null)
    {
        return $query->whereNotNull('category_id')->where(function ($q) use ($parent) {
            if ($parent)
                $q->where('category_id', $parent);
        });
    }
}
