<?php

namespace Modules\Volunteers\Http\Controllers\Charity;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Volunteers\Repositories\Charity\VolunteerRepository as Volunteer;
use Modules\Volunteers\Transformers\Charity\VolunteerResource;

class VolunteerController extends Controller
{
    private $volunteer;
    private $view_path = 'volunteers::charities.volunteers';

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
}
