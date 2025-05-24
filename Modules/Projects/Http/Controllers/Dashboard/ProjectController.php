<?php

namespace Modules\Projects\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Projects\Http\Requests\Dashboard\ProjectRequest;
use Modules\Projects\Transformers\Dashboard\ProjectResource;
use Modules\Projects\Repositories\Dashboard\ProjectRepository as Project;

class ProjectController extends Controller
{
    private $project;
    private $view_path = 'projects::dashboard.projects';

    function __construct(Project $project)
    {
        $this->project = $project;
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

    public function index()
    {
        return $this->view('index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->project->QueryTable($request));

        $datatable['data'] = ProjectResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $project = $this->project->getModel();
        return $this->view('create',compact('project'));
    }

    public function store(ProjectRequest $request)
    {
        try {
            $create = $this->project->create($request);

            if ($create) {
                return Response()->json([true , __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        return $this->view('show');
    }

    public function edit($id)
    {
        $project = $this->project->findById($id);

        return $this->view('edit',compact('project'));
    }

    public function update(ProjectRequest $request, $id)
    {
        try {
            $update = $this->project->update($request,$id);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->project->delete($id);

            if ($delete) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->project->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
