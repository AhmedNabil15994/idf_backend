<?php

namespace Modules\Volunteers\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Volunteers\Http\Requests\Dashboard\VolunteerRequest;
use Modules\Volunteers\Transformers\Dashboard\VolunteerResource;
use Modules\Volunteers\Repositories\Dashboard\VolunteerRepository as Volunteer;

class VolunteerController extends Controller
{
    private $volunteer;
    private $view_path = 'volunteers::dashboard.volunteers';

    function __construct(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
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
        $datatable = DataTable::drawTable($request, $this->volunteer->QueryTable($request));

        $datatable['data'] = VolunteerResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $volunteer = $this->volunteer->getModel();
        return $this->view('create',compact('volunteer'));
    }

    public function store(VolunteerRequest $request)
    {
        try {
            $create = $this->volunteer->create($request);

            if (is_array($create) && isset($create['status']) && $create['status'] == 0) {
                return Response()->json(['errors' =>$create['data']],400);
            }elseif ($create) {

                return Response()->json([true , __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        $volunteer = $this->volunteer->findById($id);
        return $this->view('show' , compact('volunteer'));
    }

    public function edit($id)
    {
        $volunteer = $this->volunteer->findById($id);

        return $this->view('edit',compact('volunteer'));
    }

    public function update(VolunteerRequest $request, $id)
    {
        try {
            $update = $this->volunteer->update($request,$id);

            if (is_array($update) && isset($update['status']) && $update['status'] == 0) {
                return Response()->json(['errors' =>$update['data']],400);
            }elseif ($update) {

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
            $delete = $this->volunteer->delete($id);

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
            $deleteSelected = $this->volunteer->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
