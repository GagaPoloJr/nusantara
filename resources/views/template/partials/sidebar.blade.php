<div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
    <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
        <div class="symbol symbol-50px">
            <img src="{{ asset(\Illuminate\Support\Facades\Auth::user()->image) }}" alt="">
        </div>
        <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
            <!--begin::Section-->
            <div class="d-flex">
                <!--begin::Info-->
                <div class="flex-grow-1 me-2">
                    <!--begin::Username-->
                    <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{ \Illuminate\Support\Facades\Auth::user()->user_name }}</a>
                    <!--end::Username-->
                    <!--begin::Label-->
                    <div class="d-flex align-items-center text-success fs-9">
                        <span class="bullet bullet-dot bg-success me-1"></span>online</div>
                    <!--end::Label-->
                </div>
                <!--end::Info-->

            </div>
            <!--end::Section-->
        </div>

    </div>

    <div class="aside-search py-5">
        <span class="menu-heading fw-bold text-uppercase fs-7">Navigasi</span>
    </div>
</div>
<div class="aside-menu flex-column-fluid">
    <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px" style="height: 267px;">
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
                <a class="menu-link" href="{{ url('/') }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                                <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">Halaman Utama</span>
                </a>
                <!--end:Menu link-->
            </div>

            @foreach($menus as $index => $menu)
                @can('read '.$menu->url)

            <!--begin:Menu item-->
          
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover show">
                <!--begin:Menu link-->
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 7H2V11H22V7Z" fill="currentColor" />
                                <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="currentColor" />
                            </svg>
                        </span>
                    </span>

                    <span class="menu-title">{{ $menu->menu_name}}</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    @include('template.partials.sidebar_sub',['subMenus' => $menu->subMenus, 'menus' => $menu])

                    @can('read vehicles')
                    @include('template.partials.sub_sidebar_sub',['menu_vehicles' => $menu_vehicles])
                    @endcan
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
             @endcan

            @endforeach


        </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
</div>
<!--end::Aside menu-->
<!--begin::Footer-->
<div class="aside-footer flex-column-auto py-5" id="kt_aside_footer">
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" data-kt-initialized="1" style="background: #009ef7">
            <span class="btn-label">Keluar</span>
            <i class="fa fa-sign-out"></i>
        </button>
    </form>
</div>
<!--end::Footer-->
