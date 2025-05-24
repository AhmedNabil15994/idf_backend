<?php

namespace Modules\Slider\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Projects\Entities\Project;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model implements HasMedia
{
    use SoftDeletes ,InteractsWithMedia,HasTranslations;

    protected $dates = ['start_date', 'end_date'];
    protected $fillable = [
        'title',
        'description',
        'type',
        'order',
        'start_date',
        'end_date',
        'link',
        'project_id',
        'status',
    ];
    public $translatable  = [ 'title','description' ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeActive($query)
    {

        return $query->where('status', 1);
    }

    public function scopePublished($query)
    {

        return $query->where(function ($q) {
            $q->where(function ($q) {

                $q->whereDate('start_date', '<=', Carbon::now())
                    ->orWhereNull('start_date');
            })->where(function ($q) {

                $q->whereDate('end_date', '>=', Carbon::now())
                    ->orWhereNull('end_date');
            });
        });
    }
}
