<?php

namespace Modules\Families\Http\Controllers\Charity;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Families\Transformers\Charity\FamilyResource;
use Modules\Families\Repositories\Charity\FamilyRepository as Family;

class FamilyController extends Controller
{
    private $family;
    private $view_path = 'families::charities.families';

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

    public function show($id)
    {
        $family =  $this->family->findById($id);
        return $this->view('show' , compact('family'));
    }
}
