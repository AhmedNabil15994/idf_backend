<?php

namespace Modules\Apps\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Apps\Http\Requests\FrontEnd\ContactUsRequest;
use Modules\Apps\Notifications\FrontEnd\ContactUsNotification;
use Modules\Apps\Repositories\Frontend\ContactUsRepository as ContactUs;
use Notification;

class ContactUsController extends Controller
{
    private $contactUs;

    public function __construct(ContactUs $contactUs)
    {
        $this->contactUs = $contactUs;
    }

    public function index(Request $request)
    {
        return view('apps::frontend.contact-us');
    }

    public function store(ContactUsRequest $request)
    {
        Notification::route('mail', setting('contact_us','email'))
            ->notify((new ContactUsNotification($request))->locale(locale()));

        return Response()->json([true , __('apps::frontend.contact_us.alerts.send_message')]);
    }
}
