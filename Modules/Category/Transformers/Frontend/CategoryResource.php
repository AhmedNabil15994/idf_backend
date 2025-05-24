<?php

namespace Modules\Category\Transformers\Frontend;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\Frontend\CategoryRepository;

class CategoryResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $category = new CategoryRepository(new Category);

        return [
            'id' => $this->id,
            'title' => $this->translate(locale())->title,
            'image' => $this->getFirstMediaUrl('images'),
            'children' => SubCategoryResource::collection($category->subCategories($this->id,'created_at','asc'))->jsonSerialize(),
        ];
    }
}
