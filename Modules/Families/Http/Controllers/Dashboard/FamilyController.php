<?php

namespace Modules\Families\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Families\Http\Requests\Dashboard\FamilyRequest;
use Modules\Families\Transformers\Dashboard\FamilyResource;
use Modules\Families\Repositories\Dashboard\FamilyRepository as Family;

class FamilyController extends Controller
{
    private $family;
    private $view_path = 'families::dashboard.families';

    function __construct(Family $family)
    {
        $this->family = $family;
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
        $datatable = DataTable::drawTable($request, $this->family->QueryTable($request));

        $datatable['data'] = FamilyResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $family = $this->family->getModel();
        return $this->view('create',compact('family'));
    }

    public function store(FamilyRequest $request)
    {
        try {
            $create = $this->family->create($request);

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
        return $this->view('show');
    }

    public function edit($id)
    {
        $family = $this->family->findById($id);
        return $this->view('edit',compact('family'));
    }

    public function update(FamilyRequest $request, $id)
    {
        try {
            $update = $this->family->update($request,$id);

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

    public function sortAttachment(Request $request , $id)
    {
        try {
            $update = $this->family->attachmentSort($request , $id);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.sorted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deleteAttachment($family , $media)
    {
        try {
            $delete = $this->family->deleteAttachment($family , $media);

            if ($delete) {
                return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->family->delete($id);

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
            $deleteSelected = $this->family->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
