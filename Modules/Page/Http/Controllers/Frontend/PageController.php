<?php

namespace Modules\Page\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;
use Modules\Page\Repositories\Frontend\PageRepository as Page;
use Modules\Page\Transformers\Frontend\PageResource;

class PageController extends Controller
{

    function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function show($slug)
    {
        $model = $this->page->findBySlug($slug);
        $page = (new PageResource($model))->jsonSerialize();
        $blade = array_search($model->id, setting('other')) ?? 'other';
        $background = $this->getBackGround($blade);
        return view('page::frontend.index', compact('page', 'blade','background'));
    }

    private function getBackGround($blade)
    {
        switch ($blade) {
            case 'charity' :
                return asset('frontend/images/add-charity.png');
            default:
                return null;
        }
    }
}
