<?php

namespace Modules\Projects\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Repositories\Frontend\CategoryRepository;
use Modules\Category\Transformers\Frontend\CategoryResource;
use Modules\Core\Traits\DataTable;
//use Modules\Projects\Http\Requests\Frontend\ProjectRequest;
use Modules\Projects\Transformers\Frontend\ProjectResource;
use Modules\Projects\Repositories\Frontend\ProjectRepository as Project;
use Modules\Projects\Transformers\Frontend\ShowProjectResource;

class ProjectController extends Controller
{
    private $project;
    private $category;
    private $view_path = 'projects::frontend.projects';

    function __construct(Project $project , CategoryRepository $category)
    {
        $this->project = $project;
        $this->category = $category;
    }

    /**
     * @param $view
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function view($view , $params = [])
    {
        return view($this->view_path  .'.'. $view, $params);
    }

    public function index(Request $request)
    {
        $query = $this->project->getPagination($request,'created_at','desc',6);
        $last_page = $query->lastPage();

        if ($request->ajax()) {
            $projects = ProjectResource::collection($query)->jsonSerialize();
            $view = count($projects) ? $this->view('components.data',compact('projects','last_page'))->render() : false;
            return response()->json(['html' => $view, $last_page]);
        }else{

            $categories = CategoryResource::collection($this->category->mainCategories('created_at','asc'))->jsonSerialize();
            return $this->view('index',compact('last_page','categories'));
        }
    }

    public function show(Request $request,$slug)
    {
        $model = $this->project->findBySlug($slug);
        $categories = $model->categories()->pluck('categories.id')->toArray();
        $request->merge(['categories' => $categories]);
        $projects = ProjectResource::collection($this->project->takeLike($request,$model->id,3))->jsonSerialize();
        $model = (new ShowProjectResource($model))->jsonSerialize();
        return $this->view('show',compact('model','projects'));
    }
}
