<?php

namespace Modules\Page\Repositories\Frontend;

use Modules\Page\Entities\Page;
use Hash;
use DB;

class PageRepository
{

    function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function getModel()
    {
        return $this->page;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $pages = $this->page->active()->orderBy($order, $sort)->get();
        return $pages;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $pages = $this->page->active()->orderBy($order, $sort)->get();
        return $pages;
    }

    public function findById($id)
    {
        $page = $this->page->active()->find($id);
        return $page;
    }

    public function findBySlug($slug)
    {
        $page = $this->page->active()->whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->firstOrFail();

        return $page;
    }

}
