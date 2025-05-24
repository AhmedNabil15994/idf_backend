<?php

namespace Modules\Donations\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Donations\Http\Requests\Frontend\DonateResourceRequest;
use Modules\Donations\Repositories\Frontend\DonateResourceRepository as DonateResource;
use Modules\Donations\Repositories\Frontend\ItemTypeRepository;

class DonateResourceController extends Controller
{
    private $repository;
    private $itemType;
    private $view_path = 'donations::frontend.donate-resources';

    public function __construct(DonateResource $repository , ItemTypeRepository $itemType)
    {
        $this->repository = $repository;
        $this->itemType = $itemType;
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
        $itemTypes = $this->itemType->pluckTitleAndId();
        return $this->view('index',compact('itemTypes'));
    }

    public function store(DonateResourceRequest $request)
    {
        try {
            $create = $this->repository->create($request);

            if ($create) {
                return Response()->json([true , __('apps::frontend.messages.created')]);
            }

            return Response()->json([true , __('apps::frontend.messages.failed')]);

        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
