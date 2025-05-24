<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class CategoryProject extends Model
{

    protected $table = 'category_project';
    public $timestamps = true;
    protected $fillable = array('category_id','project_id');

    public function category(){
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function project(){
        return $this->belongsTo(Project::class , 'project_id');
    }
}