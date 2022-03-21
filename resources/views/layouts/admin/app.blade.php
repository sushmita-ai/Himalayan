<!DOCTYPE html>
<html lang="en">
@include('layouts.admin.head')
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px" data-kt-aside-minimize="on">
    {{-- <div class="se-pre-con"></div> --}}
    @if (auth()->guest())
    @yield('guest')
    @else
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            @include('layouts.admin.sidebar')
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid " id="kt_wrapper">
                <!--begin::header-->
                @include('layouts.admin.header')
                <!--end::header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    {{-- @include('layouts.admin.breadcrumb') --}}
                    @yield('breadcrumb')

                    <div class="post container-fluid" id="kt_post">
                        @yield('content')
                    </div>
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">2022©</span>
                            <a href="https://keenthemes.com" target="_blank"
                                class="text-gray-800 text-hover-primary">LetItGrow</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <div class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                            Parking Management System
                            {{-- <li class="menu-item">
                                <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://keenthemes.com/support" target="_blank"
                                    class="menu-link px-2">Support</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://1.envato.market/EA4JP" target="_blank"
                                    class="menu-link px-2">Purchase</a>
                            </li> --}}
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>


        </div>
        <!--end::Wrapper-->
    </div>
    @endif
    <!--end::Page-->
    </div>
    <!--end::Root-->

    @include('layouts.admin.footer')
