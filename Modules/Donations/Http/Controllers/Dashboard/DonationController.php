<?php

namespace Modules\Donations\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Donations\Transformers\Dashboard\DonationResource;
use Modules\Donations\Repositories\Dashboard\DonationRepository as Donation;

class DonationController extends Controller
{
    private $donation;
    private $view_path = 'donations::dashboard.donations';

    function __construct(Donation $donation)
    {
        $this->donation = $donation;
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
        $datatable = DataTable::drawTable($request, $this->donation->QueryTable($request));

        $datatable['data'] = DonationResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function export(Request $request, $type)
    {
        $data = json_decode($request->data);
        $req = $data->req;
        $request->merge(['req' => (array)$req]);
        $data = $this->datatable($request);

        switch ($type) {
            case 'pdf':
            case 'print':
                return $this->donation->createPDF($data->getData()->data,$type);
                break;
            default:
                return back();
        }
    }

    public function show($id)
    {
        $donation = $this->donation->findById($id);
        return $this->view('show' , compact($donation));
    }

    public function destroy($id)
    {
        try {
            $delete = $this->donation->delete($id);

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
            $deleteSelected = $this->donation->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
