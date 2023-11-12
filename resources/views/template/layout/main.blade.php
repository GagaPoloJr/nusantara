<!DOCTYPE html>

<html lang="en">
<head>
    <base href=""/>
    <title>Nusantara</title>
    <meta charset="utf-8"/>
    <meta name="description"
          content="Boilerplate."/>
    <meta name="keywords"
          content="assets, laravel, bootstrap 5, datatables, flaticon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/icon2.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/other/font.css') }}"/>
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/plugins/global/plugins.bundle_old.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    
    @stack('css')
</head>
<body id="kt_body" class="page-loading-enabled page-loading header-tablet-and-mobile-fixed aside-enabled">
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
            if (localStorage.getItem("data-theme") !== null) {
                themeMode = localStorage.getItem("data-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }</script>

<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle" style="">
            @include('template.partials.sidebar');
        </div>
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            @include('template.partials.header')
            <div class="mb-10">
                <div>
                    @include('dashboard')
                </div>
            </div>
            @yield('container')
            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-center">
                    <div class="text-dark">
                        <span class="text-muted fw-semibold me-1">Copyright &copy IT Nusantara 2023</span>
                        <a href="javascript:void(0)" class="text-gray-800 text-hover-primary">👉{{ $version }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="kt_engage_demos" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="explore"
     data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-direction="end"
     data-kt-drawer-toggle="#kt_engage_demos_toggle" data-kt-drawer-close="#kt_engage_demos_close">
    <div class="card shadow-none rounded-0 w-100">
        <div class="card-header" id="kt_engage_demos_header">
            <h3 class="card-title fw-bold text-gray-700">Pemberitahuan</h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-icon btn-active-color-primary h-40px w-40px me-n6" id="kt_engage_demos_close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
        <div class="card-body" id="kt_engage_demos_body">
            <div id="kt_explore_scroll" class="scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_engage_demos_body" data-kt-scroll-dependencies="#kt_engage_demos_header" data-kt-scroll-offset="5px" style="height: 489px;">
                <div class="mb-0">
                    @foreach($notifications as $notification)
                        {{--<div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="d-flex flex-center w-50px h-50px w-lg-75px h-lg-75px flex-shrink-0 rounded bg-light-primary">
                                        <span class="svg-icon svg-icon-primary svg-icon-2x svg-icon-lg-3x">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor" />
                                            <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor"></path>
                                            <rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor"></rect>
                                            <rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                </div>
                                <div class="d-flex flex-stack flex-grow-1 ms-4 ms-lg-6">
                                    <div class="d-flex flex-column me-2 me-lg-5">
                                        <a href="javascript:void(0)" data-id="{{ $notification->notification_id }}" data-value="{{ $notification->action }}" id="btn_notification" class="text-dark text-hover-primary fw-bold fs-6 fs-lg-4 mb-1">{{ $notification->ticket_id }}</a>
                                        <div class="text-muted fw-semibold fs-8 fs-lg-6">{!! strlen($notification->content) < 65?$notification->content:substr(str_replace(['*','_'],[''],$notification->content), 0, 65) . "..."  !!}.</div>
                                    </div>
                                    <span class="svg-icon svg-icon-gray-400 svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                            <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>--}}
                        <a href="javascript:void(0)" data-id="{{ $notification->notification_id }}" data-value="{{ $notification->action }}" id="btn_notification">
                        <div class="alert alert-dismissible bg-light-success bg-opacity-90 d-flex flex-column flex-sm-row w-100 p-5 mb-2">
                            <!--begin::Icon-->
                            <i class="fa fa-bell fa-shake fs-2hx text-warning me-4 mb-5 mb-sm-0"  style="--fa-animation-duration: 3s;"></i>

                            <!--begin::Content-->
                            <div class="d-flex flex-column text-black-50 pe-0 pe-sm-10">
                                <h4 class="mb-2 text-black-50">{{ $notification->ticket_id }} 👉 {{ $notification->title }}</h4>
                                <span>{!! strlen($notification->content) < 50?$notification->content:substr(str_replace(['*','_'],[''],$notification->content), 0, 50) . "..."  !!}.</span>
                            </div>
                            <!--end::Content-->

                            <!--begin::Close-->
                            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                <i class="ki-duotone ki-cross fs-2x text-light"><span class="path1"></span><span class="path2"></span></i>                    </button>
                            <!--end::Close-->
                        </div>
                        </a>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="engage-toolbar d-flex position-fixed px-5 fw-bold zindex-2 top-50 end-0 transform-90 mt-5 mt-lg-20 gap-2">
    {{--<button id="kt_engage_demos_toggle"
            class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0"
            title="Pemberitahuan" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-dismiss="click"
            data-bs-trigger="hover">
            <span id="kt_engage_demos_label"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3" d="M4.05424 15.1982C8.34524 7.76818 13.5782 3.26318 20.9282 2.01418C21.0729 1.98837 21.2216 1.99789 21.3618 2.04193C21.502 2.08597 21.6294 2.16323 21.7333 2.26712C21.8372 2.37101 21.9144 2.49846 21.9585 2.63863C22.0025 2.7788 22.012 2.92754 21.9862 3.07218C20.7372 10.4222 16.2322 15.6552 8.80224 19.9462L4.05424 15.1982ZM3.81924 17.3372L2.63324 20.4482C2.58427 20.5765 2.5735 20.7163 2.6022 20.8507C2.63091 20.9851 2.69788 21.1082 2.79503 21.2054C2.89218 21.3025 3.01536 21.3695 3.14972 21.3982C3.28408 21.4269 3.42387 21.4161 3.55224 21.3672L6.66524 20.1802L3.81924 17.3372ZM16.5002 5.99818C16.2036 5.99818 15.9136 6.08615 15.6669 6.25097C15.4202 6.41579 15.228 6.65006 15.1144 6.92415C15.0009 7.19824 14.9712 7.49984 15.0291 7.79081C15.0869 8.08178 15.2298 8.34906 15.4396 8.55884C15.6494 8.76862 15.9166 8.91148 16.2076 8.96935C16.4986 9.02723 16.8002 8.99753 17.0743 8.884C17.3484 8.77046 17.5826 8.5782 17.7474 8.33153C17.9123 8.08486 18.0002 7.79485 18.0002 7.49818C18.0002 7.10035 17.8422 6.71882 17.5609 6.43752C17.2796 6.15621 16.8981 5.99818 16.5002 5.99818Z" fill="currentColor"></path>
                <path d="M4.05423 15.1982L2.24723 13.3912C2.15505 13.299 2.08547 13.1867 2.04395 13.0632C2.00243 12.9396 1.9901 12.8081 2.00793 12.679C2.02575 12.5498 2.07325 12.4266 2.14669 12.3189C2.22013 12.2112 2.31752 12.1219 2.43123 12.0582L9.15323 8.28918C7.17353 10.3717 5.4607 12.6926 4.05423 15.1982ZM8.80023 19.9442L10.6072 21.7512C10.6994 21.8434 10.8117 21.9129 10.9352 21.9545C11.0588 21.996 11.1903 22.0083 11.3195 21.9905C11.4486 21.9727 11.5718 21.9252 11.6795 21.8517C11.7872 21.7783 11.8765 21.6809 11.9402 21.5672L15.7092 14.8442C13.6269 16.8245 11.3061 18.5377 8.80023 19.9442ZM7.04023 18.1832L12.5832 12.6402C12.7381 12.4759 12.8228 12.2577 12.8195 12.032C12.8161 11.8063 12.725 11.5907 12.5653 11.4311C12.4057 11.2714 12.1901 11.1803 11.9644 11.1769C11.7387 11.1736 11.5205 11.2583 11.3562 11.4132L5.81323 16.9562L7.04023 18.1832Z" fill="currentColor"></path>
            </svg></span>
    </button>--}}
</div>


<script>var hostUrl = "{{ asset('assets') }}/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $('a#btn_notification').on('click', function () {
        let data = $(this).data();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: `{{ url('notification/') }}/`+data.id,
            type: "GET",
            success:function(response)
            {
                window.location.replace(data.value);
            },
            error: function(data) {
                var errors = data.responseJSON;
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: errors['message'],
                })
            }
        });
    });
</script>

@stack('js')
</body>
</html>
