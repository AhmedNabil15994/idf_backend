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
                <a href="{{ url(route('charities.home')) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ __('apps::charities.index.title') }}</span>
                    <span class="selected"></span>
                </a>
            </li>


            <li class="heading">
                <h3 class="uppercase">{{ __('apps::charities._layout.aside._tabs.controlling') }}</h3>
            </li>
            <li class="nav-item {{ active_menu('families') }}">
                <a href="{{ url(route('charities.families.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('apps::charities._layout.aside.families') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item {{ active_menu('volunteers') }}">
                <a href="{{ url(route('charities.volunteers.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('apps::charities._layout.aside.volunteers') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item {{ active_menu('orders') }}">
                <a href="{{ url(route('charities.orders.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('apps::charities._layout.aside.orders') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

        </ul>
    </div>

</div>
