<div class="loader_container" id="loader_container">
    <div class="loader" id="page_loader">Loading...</div>
</div>

<header class="header-area" id="header-area">
    <div class="top-header">
        <div class="container">
            <ul class="list-inline d-flex justify-content-end align-items-center">
                @if(!$donorCheck)
                    <li class="list-inline-item"><a
                                href="{{route('frontend.auth.login')}}"> {{__('apps::frontend.home._header.login')}}</a>
                    </li>
                @else
                    <li class="list-inline-item"><i class="lnr lnr-user"></i> {{auth()->user()->name}}</li>
                    <li class="list-inline-item">
                        <a href="{{route('frontend.auth.logout')}}">
                            <i class="fa fa-sign-out-alt"></i>
                            {{__('apps::frontend.home._header.logout')}}
                        </a>
                    </li>

                @endif
                <li class="list-inline-item"><a href="https://wa.me/{{ setting('contact_us','whatsapp') }}"
                                                data-action="share/whatsapp/share"
                    ><i
                                class="lnr lnr-phone-handset"></i> {{ setting('contact_us','whatsapp') }}</a></li>
            </ul>
        </div>

    </div>
    <nav class="container">
        <div class="main-header d-flex align-items-center justify-content-between">
            <a class="site-logo" href="{{url(route('frontend.home'))}}">
                <img src="{{url(setting('logo'))}}" class="img-fluid" alt="Img"/>
            </a>
            <div class="header-menu">


                <a class="{{ (request()->segment(2) == '')  ? 'active' : ''}}" href="{{url(route('frontend.home'))}}">{{__('apps::frontend.home._header.home')}}</a>
                <a class="{{ (request()->segment(2) == 'projects') ? 'active' : ''}}"
                    href="{{url(route('frontend.projects.index'))}}">{{__('apps::frontend.home._header.projects')}}</a>

                <a class="{{ (request()->segment(3) == $charities_page['slug'] ) ? 'active' : ''}}" href="{{$charities_page ? url(route('front.pages.show',$charities_page['slug'])) : '#'}}">{{__('apps::frontend.home._header.partners')}}</a>
                <a class="{{ (request()->segment(3) == $about_us_page['slug']) ? 'active' : ''}}" href="{{$about_us_page ? url(route('front.pages.show',$about_us_page['slug'])) : '#'}}">{{__('apps::frontend.home._header.about_us')}}</a>
                <a class="{{ (request()->segment(2) == 'contact-us') ? 'active' : ''}}"
                    href="{{url(route('frontend.contact-us.index'))}}">{{__('apps::frontend.home._header.contact_us')}}</a>
            </div>

            <div class="header-left d-flex justify-content-end">
                <a href="{{url(route('frontend.cart.index'))}}" class="cart-bag">
                    <i class="fa fa-shopping-bag">
                        <span id="cart_counter" style="display: {{$cart_count > 0 ? 'block':'none'}};">
                            @if($cart_count > 0)
                                {{$cart_count}}
                            @endif
                        </span>
                    </i>
                </a>
                <select class="nice-select language-select" id="lang-select">
                    @foreach (config('laravellocalization.supportedLocales') as $localeCode => $properties)
                        <option {{$localeCode == locale() ? 'selected' : ''}} value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                class="lang-options">
                            {{strtoupper($localeCode)}}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="responsive-menu"><i class="ti-align-justify"></i></button>
        </div>
    </nav>
</header>

@push('scripts')
    <script>

        $('body').css('overflow', 'hidden');
        $(window).on("load", function () {
            $('body').css('overflow', 'auto');
            $('#loader_container').hide();
        });

        $('#lang-select').change(function () {

            window.location.replace($(this).val());
        });
    </script>
@endpush
