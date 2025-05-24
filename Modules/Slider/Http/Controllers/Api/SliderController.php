<?php

namespace Modules\Slider\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Slider\Transformers\Api\SliderResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Slider\Repositories\Api\SliderRepository as Slider;

class SliderController extends ApiController
{

    function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function sliders(Request $request)
    {
        $sliders =  $this->slider->getAll($request);
        return SliderResource::collection($sliders);
    }
}
