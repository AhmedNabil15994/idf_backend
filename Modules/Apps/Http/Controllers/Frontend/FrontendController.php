<?php

namespace Modules\Apps\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Catalog\Repositories\Frontend\HomeCardRepository;
use Modules\Catalog\Transformers\Frontend\HomeCardsResource;
use Modules\Catalog\Transformers\Frontend\PartnerResource;
use Modules\Catalog\Transformers\Frontend\StatisticsResource;
use Modules\Catalog\Repositories\Frontend\PartnerRepository;
use Modules\Catalog\Repositories\Frontend\StatisticsRepository;
use Modules\Projects\Entities\Project;
use Modules\Projects\Repositories\Frontend\ProjectRepository;
use Modules\Projects\Transformers\Frontend\ProjectResource;
use Modules\Slider\Repositories\Frontend\SliderRepository;
use Modules\Slider\Transformers\Frontend\SliderResource;

class FrontendController extends Controller
{
    private $project;
    private $slider;
    private $partner;
    private $statistics;
    private $homeCards;

    public function __construct(ProjectRepository $project,SliderRepository $slider, PartnerRepository $partner, StatisticsRepository $statistics , HomeCardRepository $homeCards)
    {
        $this->project = $project;
        $this->slider = $slider;
        $this->partner = $partner;
        $this->statistics = $statistics;
        $this->homeCards = $homeCards;
    }

    public function index(Request $request)
    {
        $projects = ProjectResource::collection($this->project->take($request))->jsonSerialize();
        $sliders = SliderResource::collection($this->slider->getAllActive())->jsonSerialize();
        $partners = PartnerResource::collection($this->partner->getAllActive())->jsonSerialize();
        $statistics = StatisticsResource::collection($this->statistics->getAllActive())->jsonSerialize();
        $homeCards = HomeCardsResource::collection($this->homeCards->getAllActive())->jsonSerialize();



        $slug = "دفعة بلاء ( ربع دينار يومي )";
//        $data = Project::
//            whereHas('translations', function ($query) use ($slug) {
//                $query->where('slug', 'LIKE' , '%' . $slug . '%');
//            })->first();

        $data = Project::where('link', 'LIKE' , '%' . $slug . '%')->first();
        if ($data) {
            $project = ProjectResource::make($data)->jsonSerialize();
        }else{
            $project = Project::first();
        }

        return view('apps::frontend.index', compact('projects', 'sliders', 'statistics', 'partners','homeCards' , 'project'));
    }
}
