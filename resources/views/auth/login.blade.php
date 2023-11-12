
<!DOCTYPE html>

<html lang="en" >
<!--begin::Head-->
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
<!--end::Head-->

<!--begin::Body-->
<body  id="kt_body"  class="auth-bg" >
<!--begin::Theme mode setup on page load-->
<script>
    var defaultThemeMode = "light";
    var themeMode;

    if ( document.documentElement ) {
        if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if ( localStorage.getItem("data-bs-theme") !== null ) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }

        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
<!--end::Theme mode setup on page load-->
<!--Begin::Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!--End::Google Tag Manager (noscript) -->

<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">

    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-md-500px w-sm-500px p-10 card shadow-lg mb-5">
                    <form class="form w-100" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">
                                LOGIN
                            </h1>
                            <div class="text-gray-500 fw-semibold fs-6">
                                <!-- Email Address -->
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control bg-transparent" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="form-control bg-transparent"
                                                  type="password"
                                                  name="password"
                                                  required autocomplete="current-password"
                                                  oninput="this.value = this.value.toLowerCase()"/>

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <div class="d-grid mb-10">
                                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary rounded-pill btn-sm">

                                            <!--begin::Indicator label-->
                                            <span class="indicator-label">
                                            Masuk</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="text-gray-500 text-center fw-semibold fs-6 mb-5">
                            Belum punya akun ?
                            <a href="{{ route('register') }}" class="link-primary fw-semibold">
                                Daftar sekarang
                            </a>
                        </div>
                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            Buku Panduan Boilerplate
                            <a href="{{ route('download.manualbook') }}" class="link-primary fw-semibold" target="_blank">
                                <i class="fa fa-download"></i>Unduh
                            </a>
                        </div>
                        <!--end::Sign up-->
                    </form>
                    <!--end::Form-->

                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->

            <!--begin::Footer-->
            <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                <div class="me-10">
                    {{--<button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                        <img  data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="/metronic8/demo8/assets/media/flags/united-states.svg" alt=""/>

                        <span data-kt-element="current-lang-name" class="me-1">English</span>

                        <i class="ki-duotone ki-down fs-5 text-muted rotate-180 m-0"></i>
                    </button>--}}
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="" alt=""/>
                                </span>
                                <span data-kt-element="lang-name">English</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="" alt=""/>
                                </span>
                                <span data-kt-element="lang-name">Spanish</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="" alt=""/>
                                </span>
                                <span data-kt-element="lang-name">German</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="" alt=""/>
                                </span>
                                <span data-kt-element="lang-name">Japanese</span>
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="" alt=""/>
                                </span>
                                <span data-kt-element="lang-name">French</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex fw-semibold text-primary fs-base gap-2">
                    <a href="javasscript:void(0)">Copyright IT Nusantara 2023</a>
                </div>
            </div>
        </div>
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-color: #003c1b;">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <!--begin::Logo-->
                <a href="" class="mb-0 mb-lg-12">
                    {{-- <img alt="Logo" src="{{ asset('assets/media/other/image3.png') }}" class="h-60px h-lg-150px"/> --}}
                </a>
                <!--end::Logo-->

                <!--begin::Image-->
                {{-- <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ asset('assets/images/image3.png') }}" alt=""/> --}}
                <img class="d-none d-lg-block mx-auto w-75px w-md-50 w-xl-200px mb-10 mb-lg-15" src="{{ asset('assets/media/other/image3.png') }}" alt=""/>
                <!--end::Image-->

                <!--begin::Title-->
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">
                    Selamat Datang, Di Nusa Group
                </h1>
                <!--end::Title-->

                <!--begin::Text-->
                <div class="d-none d-lg-block text-white fs-base text-center">
                    Silahkan login untuk mengakses halaman.
                </div>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
    </div>


</div>

<script>var hostUrl = "{{ asset('assets') }}/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@stack('js')

</body>
<!--end::Body-->
</html>
