<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model 
{
    protected $table = 'project_translations';
    public $timestamps = true;
    protected $fillable = array('title','slug','description', 'locale', 'project_id');
}