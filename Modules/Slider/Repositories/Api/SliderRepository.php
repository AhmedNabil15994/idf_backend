<?php

namespace Modules\Slider\Repositories\Api;

use Modules\Slider\Entities\Slider;

class SliderRepository
{
    function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function getAll($request)
    {
        $sliders = $this->slider->Active()->Published()->orderBy('order')->get();

        return $sliders;
    }
}
