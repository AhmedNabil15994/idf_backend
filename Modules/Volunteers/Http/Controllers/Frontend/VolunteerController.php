<?php

namespace Modules\Volunteers\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;
use Modules\Volunteers\Http\Requests\Frontend\VolunteerRequest;
use Modules\Volunteers\Repositories\Frontend\VolunteerRepository as Volunteer;

class VolunteerController extends Controller
{
    private $volunteer;
    private $view_path = 'volunteers::frontend.volunteers';

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

}
