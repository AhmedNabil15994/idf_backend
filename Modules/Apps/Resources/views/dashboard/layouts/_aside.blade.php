<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed"
            data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>


            <li class="nav-item {{ active_menu('home') }}">
                <a href="{{ url(route('dashboard.home')) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ __('apps::dashboard.index.title') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            @canany(['show_roles','show_admins'])
                <li class="nav-item  {{active_slide_menu(['roles','admins'])}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside._tabs.users') }}</span>
                        <span class="arrow {{active_slide_menu(['roles','admins'])}}"></span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        @can('show_roles')
                            <li class="nav-item {{ active_menu('roles') }}">
                                <a href="{{ url(route('dashboard.roles.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.roles') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_admins')
                            <li class="nav-item {{ active_menu('admins') }}">
                                <a href="{{ url(route('dashboard.admins.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.admins') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            

            <li class="heading">
                <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.projects') }}</h3>
            </li>

            @can('show_donations')
                <li class="nav-item {{ active_menu('donations') }}">
                    <a href="{{ url(route('dashboard.donations.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.donations') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_donors')
                <li class="nav-item {{ active_menu('donors') }}">
                    <a href="{{ url(route('dashboard.donors.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.donors') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_projects')
                <li class="nav-item {{ active_menu('projects') }}">
                    <a href="{{ url(route('dashboard.projects.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.projects') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{ active_menu('prices') }}">
                    <a href="{{ url(route('dashboard.prices.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.donate_prices') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_categories')
                <li class="nav-item {{ active_menu('categories') }}">
                    <a href="{{ url(route('dashboard.categories.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.categories') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan


            <li class="heading">
                <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.donate_resources') }}</h3>
            </li>

            @can('show_donate_resources')
                <li class="nav-item {{ active_menu('donate_resources') }}">
                    <a href="{{ url(route('dashboard.donate_resources.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.donate_resources') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_item_types')
                <li class="nav-item {{ active_menu('item_types') }}">
                    <a href="{{ url(route('dashboard.item_types.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title"
                              style="font-size:13px">{{ __('apps::dashboard._layout.aside.item_types') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @canany(['show_sliders','show_partners','show_statistics'])
                <li class="nav-item  {{active_slide_menu(['sliders','partners','statistics','home-cards'])}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside._tabs.home') }}</span>
                        <span class="arrow {{active_slide_menu(['sliders','partners','statistics','home-cards'])}}"></span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        @can('show_sliders')
                            <li class="nav-item {{ active_menu('sliders') }}">
                                <a href="{{ url(route('dashboard.sliders.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.sliders') }}</span>
                                </a>
                            </li>
                        @endcan

                        @can('show_partners')
                            <li class="nav-item {{ active_menu('partners') }}">
                                <a href="{{ url(route('dashboard.partners.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.partners') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_statistics')
                            <li class="nav-item {{ active_menu('statistics') }}">
                                <a href="{{ url(route('dashboard.statistics.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.statistics') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

{{--                        @can('show_statistics')--}}
                            <li class="nav-item {{ active_menu('home-cards') }}">
                                <a href="{{ url(route('dashboard.home-cards.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.home-cards') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
{{--                        @endcan--}}
                    </ul>
                </li>
            @endcanany


            @canany(['show_religions','show_nationalities','show_pages','edit_settings','show_countries','show_governorates','show_cities'])
                )
                <li class="nav-item  {{active_slide_menu(['charters','religions','nationalities','pages','setting','countries','governorates','cities'])}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside._tabs.settings') }}</span>
                        <span class="arrow {{active_slide_menu(['charters','religions','nationalities','pages','setting','countries','governorates','cities'])}}"></span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">

                        <li class="nav-item {{ active_menu('charters') }}">
                            <a href="{{ url(route('dashboard.charters.index')) }}" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">{{ __('apps::dashboard._layout.aside.charters') }}</span>
                                <span class="selected"></span>
                            </a>
                        </li>

                        @canany(['show_countries','show_governorates','show_cities'])
                            <li class="nav-item  {{active_slide_menu(['countries','governorates','cities'])}}">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside._tabs.areas') }}</span>
                                    <span class="arrow {{active_slide_menu(['countries','governorates','cities'])}}"></span>
                                    <span class="selected"></span>
                                </a>
                                <ul class="sub-menu">

                                    @can('show_countries')
                                        <li class="nav-item {{ active_menu('countries') }}">
                                            <a href="{{ url(route('dashboard.countries.index')) }}"
                                               class="nav-link nav-toggle">
                                                <i class="icon-settings"></i>
                                                <span class="title">{{ __('apps::dashboard._layout.aside.countries') }}</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('show_governorates')
                                        <li class="nav-item {{ active_menu('governorates') }}">
                                            <a href="{{ url(route('dashboard.governorates.index')) }}"
                                               class="nav-link nav-toggle">
                                                <i class="icon-settings"></i>
                                                <span class="title">{{ __('apps::dashboard._layout.aside.governorates') }}</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('show_cities')
                                        <li class="nav-item {{ active_menu('cities') }}">
                                            <a href="{{ url(route('dashboard.cities.index')) }}"
                                               class="nav-link nav-toggle">
                                                <i class="icon-settings"></i>
                                                <span class="title">{{ __('apps::dashboard._layout.aside.cities') }}</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany

                        @can('show_religions')
                            <li class="nav-item {{ active_menu('religions') }}">
                                <a href="{{ url(route('dashboard.religions.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.religions') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_nationalities')
                            <li class="nav-item {{ active_menu('nationalities') }}">
                                <a href="{{ url(route('dashboard.nationalities.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.nationalities') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_pages')
                            <li class="nav-item {{ active_menu('pages') }}">
                                <a href="{{ url(route('dashboard.pages.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.pages') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('edit_settings')
                            <li class="nav-item {{ active_menu('setting') }}">
                                <a href="{{ url(route('dashboard.setting.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.setting') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcanany
        </ul>
    </div>

</div>
