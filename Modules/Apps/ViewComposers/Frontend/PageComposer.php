<?php

namespace Modules\Apps\ViewComposers\Frontend;

use Modules\Authentication\Foundation\DonorAuthentication;
use Modules\Page\Repositories\Frontend\PageRepository as Page;
use Illuminate\View\View;
use Modules\Page\Transformers\Frontend\PageResource;
use Cart;

class PageComposer
{
    use DonorAuthentication;

    public $pages = [];

    public function __construct(Page $page)
    {
        $this->pages =  $page;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = auth()->user();
        $cart_count = Cart::count();
        $about_us_page = $this->pages->findById(setting('other', 'about_us'));
        $charities_page = $this->pages->findById(setting('other', 'charity'));
        $volunteers_page = $this->pages->findById(setting('other', 'volunteer'));
        $privacy_policy = $this->pages->findById(setting('other', 'terms'));
        $charters = $this->pages->findById(setting('other', 'charters'));
        $about_us_page = $about_us_page ? (new PageResource($about_us_page))->jsonSerialize() : null;
        $charities_page = $charities_page ? (new PageResource($charities_page))->jsonSerialize() : null;
        $privacy_policy = $privacy_policy ? (new PageResource($privacy_policy))->jsonSerialize() : null;
        $donorCheck = $user && $user->donor && $user->donor->status == 1 ? true : false;
        $view->with(compact('about_us_page','charities_page','privacy_policy','charters','volunteers_page','cart_count','donorCheck'));
    }
}
