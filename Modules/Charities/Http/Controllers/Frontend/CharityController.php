<?php

namespace Modules\Charities\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Charities\Http\Requests\Frontend\CharityRequest;
use Modules\Charities\Repositories\Frontend\CharityRepository as Charity;

class CharityController extends Controller
{
    private $charity;
    private $view_path = 'charities::frontend.charities';

    function __construct(Charity $charity)
    {
        $this->charity = $charity;
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

    public function store(CharityRequest $request)
    {
        try {
            $create = $this->charity->create($request);

            if (is_array($create) && isset($create['status']) && $create['status'] == 0) {
                return Response()->json(['errors' =>$create['data']],400);
            }elseif ($create) {

                return Response()->json([true , __('apps::frontend.messages.created')]);
            }

            return Response()->json([true , __('apps::frontend.messages.failed')]);

        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
