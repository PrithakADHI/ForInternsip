<aside class="layout-menu menu-vertical menu bg-menu-theme" id="layout-menu">
    <div class="app-brand demo d-flex justify-content-center">
        <a class="app-brand-link" href="{{ route('home') }}">
            <img class=""
                src="{{ $settings['site_main_logo'] ? asset('admin/images/setting/' . $settings['site_main_logo']) : asset('admin/images/logo.png') }}"
                alt="" height="50">
        </a>
        <a class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none" href="javascript:void(0);">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-2">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('dashboard') }}">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- CMS -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">CMS</span></li>
        <!-- Cards -->

        <li class="menu-item {{ Request::segment(2) == 'blogs' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.blogs.index') }}">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Basic">Blogs</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'countries' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.countries.index') }}">
                <i class="menu-icon fa fa-globe"></i>
                <div data-i18n="Basic">Countries</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'courses' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.courses.index') }}">
                <i class="menu-icon fa fa-book"></i>
                <div data-i18n="Basic">Courses</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'services' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.services.index') }}">
                <i class="menu-icon fa fa-headphones"></i>
                <div data-i18n="Basic">Services</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'universities' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.universities.index') }}">
                <i class="menu-icon fa fa-university"></i>
                <div data-i18n="Basic">Universities</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'testimonials' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.testimonials.index') }}">
                <i class="menu-icon fa fa-commenting"></i>
                <div data-i18n="Basic">Testimonials</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'teams' ? 'active' : '' }}">
            <a class="menu-link" href="{{ route('admin.teams.index') }}">
                <i class="menu-icon fa fa-users"></i>
                <div data-i18n="Basic">Teams</div>
            </a>
        </li>

        <!-- General Settings  -->
        <li class="menu-item @if (Request::segment(2) == 'settings') {{ 'active open' }} @endif">
            <a class="menu-link menu-toggle" href="javascript:void(0)">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="General Setting">Settings</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item">
                    <a class="menu-link {{ Request::segment(2) == 'settings' ? 'active' : '' }}"
                        href="{{ route('admin.settings.index') }}">
                        <div data-i18n="Accordion">Global Settings</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
