<?php

namespace Modules\Families\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Families\Http\Requests\Frontend\FamilyRequest;
use Modules\Families\Repositories\Frontend\FamilyRepository as Family;

class FamilyController extends Controller
{
    private $repository;
    private $view_path = 'families::frontend.families';

    public function __construct(Family $repository)
    {
        $this->repository = $repository;
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
        return $this->view('index');
    }

    public function store(FamilyRequest $request)
    {
        try {
            $create = $this->repository->create($request);

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
}
