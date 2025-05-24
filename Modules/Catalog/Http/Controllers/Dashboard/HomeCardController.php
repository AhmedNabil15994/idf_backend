<?php

namespace Modules\Catalog\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Catalog\Http\Requests\Dashboard\HomeCardRequest;
use Modules\Catalog\Repositories\Dashboard\HomeCardRepository;
use Modules\Catalog\Repositories\Dashboard\StatisticsRepository;
use Modules\Catalog\Transformers\Dashboard\HomeCardsResource;
use Modules\Core\Traits\DataTable;
use Modules\Catalog\Http\Requests\Dashboard\StatisticsRequest;
use Modules\Catalog\Transformers\Dashboard\StatisticsResource;

class HomeCardController extends Controller
{
    private $card;

    function __construct(HomeCardRepository $card)
    {
        $this->card = $card;
    }

    public function index()
    {
        return view('catalog::dashboard.home-cards.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->card->QueryTable($request));

        $datatable['data'] = HomeCardsResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $card = $this->card->getModel();
        return view('catalog::dashboard.home-cards.create',compact('card'));
    }

    public function store(StatisticsRequest $request)
    {
        try {
            $create = $this->card->create($request);

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
        return view('catalog::dashboard.home-cards.show');
    }

    public function edit($id)
    {
        $card = $this->card->findById($id);

        return view('catalog::dashboard.home-cards.edit',compact('card'));
    }

    public function update(HomeCardRequest $request, $id)
    {
        try {
            $update = $this->card->update($request,$id);

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
            $delete = $this->card->delete($id);

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
            $deleteSelected = $this->card->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
