
<!DOCTYPE html>

<html lang="en" >
<!--begin::Head-->
<head>
    <base href=""/>
    <title>Boilerplate</title>
    <meta charset="utf-8"/>
    <meta name="description"
          content="Boilerplate."/>
    <meta name="keywords"
          content="assets, laravel, bootstrap 5, datatables, flaticon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/icon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/other/font.css') }}"/>
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/plugins/global/plugins.bundle_old.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    @stack('css')
</head>

<body  id="kt_body"  class="auth-bg" >

<div class="d-flex flex-column flex-root">

    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-650px p-10 card shadow-lg mb-5">
                    <form class="form w-100" novalidate="novalidate" id="formvalidation" action="#" autocomplete="off">
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">
                                DAFTAR
                            </h1>
                            <div class="text-gray-500 fw-semibold fs-6">

                            </div>
                        </div>
                        <div class="col-md-12 fv-row mb-5">
                            <label class="required fw-semibold fs-6 mb-2">Perusahaan</label>
                            <select class="form-select" name="company" data-control="select2"  data-placeholder="Pilih perusahaan" id="company">
                                <option></option>
                                @foreach($companys as $company)
                                    <option value="{{ $company->company_id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 fv-row mb-5">
                            <label class="required fw-semibold fs-6 mb-2">Nama Lengkap</label>
                            <input type="text" class="form-control" name="user_name" id="user_name">
                        </div>
                        <div class="fv-row mb-5">
                            <label class="required fw-semibold fs-6 mb-5">Jenis Kelamin</label>
                            <div class="form-check form-check-custom form-check-solid mb-2">
                                <input class="form-check-input" type="radio" name="gender" value="L" id="gender" checked/>
                                <label class="form-check-label">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" name="gender" value="P" id="gender"/>
                                <label class="form-check-label">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 fv-row mb-5">
                                <label class="required fw-semibold fs-6 mb-2">Nomor Whatsapp</label>
                                <input type="text" class="form-control form-select-md" name="no_hp" id="no_hp">
                            </div>
                            <div class="col-md-6 fv-row mb-5">
                                <label class="fw-semibold fs-6 mb-2">Foto</label>
                                <input
                                    type="file"
                                    name="image"
                                    id="inputImage"
                                    accept="image/png, image/jpg, image/jpeg"
                                    class="form-control form-select-md">
                            </div>
                            <div class="col-md-6 fv-row mb-5">
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <input type="email" class="form-control form-select-md" name="email" id="email">
                            </div>
                            <div class="col-md-6 fv-row mb-5">
                                <label class="required fw-semibold fs-6 mb-2">Password</label>
                                <input type="password" class="form-control form-select-md" name="password" id="password" oninput="this.value = this.value.toLowerCase()">
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <div class="d-grid mb-10">
                                <button id="submit" type="submit" class="btn btn-primary rounded-pill btn-sm">
                                    <span class="indicator-label">
                                        <i class="fa fa-save"></i>
                                        Simpan
                                    </span>
                                    <span class="indicator-progress">
                                            Tunggu sebentar...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            Sudah punya akun ?

                            <a href="{{ route('login') }}" class="link-primary fw-semibold">
                                Masuk sekarang
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
                </div>
                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                    <a href="javasscript:void(0)">Copyright &copy IT Nusantara 2023</a>
                </div>
            </div>
        </div>
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-color: #003c1b;">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <!--begin::Logo-->
                <a href="" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="{{ asset('assets/media/other/image3.png') }}" class="h-60px h-lg-150px"/>
                </a>
                <!--end::Logo-->

                <!--begin::Image-->
                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ asset('assets/images/logo1.png') }}" alt=""/>
                <!--end::Image-->

                <!--begin::Title-->
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">
                    Selamat Datang, Di Nusantara Group
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
<script>
   $(document).ready(function (){
       if($('form').length){
           $('select#company').select2();
           const form = document.getElementById('formvalidation');
           var validator = FormValidation.formValidation(
               form,
               {
                   fields: {
                       'user_name': {
                           validators: {
                               notEmpty: {
                                   message: 'Tidak boleh kosong'
                               }
                           }
                       },
                       'company': {
                           validators: {
                               notEmpty: {
                                   message: 'Tidak boleh kosong'
                               }
                           }
                       },
                       'no_hp': {
                           validators: {
                               notEmpty: {
                                   message: 'Tidak boleh kosong',
                               },
                               numeric: {
                                   message: 'Harus angka',
                               },
                               stringLength: {
                                   message: 'Paling sedikit 11 karakter & paling banyak 15 karakter',
                                   min: 11,
                                   max: 15,
                               },
                           }
                       },
                       'email': {
                           validators: {
                               emailAddress: {
                                   message: 'email tidak sesuai'
                               },
                               notEmpty: {
                                   message: 'Tidak boleh kosong'
                               }
                           }
                       },
                       'password': {
                           validators: {
                               notEmpty: {
                                   message: 'Tidak boleh kosong'
                               }
                           }
                       },
                       'image': {
                           validators: {
                               file: {
                                   extension: 'jpeg,jpg,png',
                                   type: 'image/jpeg,image/jpg,image/png',
                                   maxSize: 1024 * 1024,
                                   message: 'Berkas tidak valid, format yang diperbolehkan jpeg/jpg/png'
                               }
                           }
                       },
                   },
                   plugins: {
                       trigger: new FormValidation.plugins.Trigger(),
                       bootstrap: new FormValidation.plugins.Bootstrap5({
                           rowSelector: '.fv-row',
                           eleInvalidClass: '',
                           eleValidClass: ''
                       })
                   }
               }
           );
           const submitButton = document.getElementById('submit');
           submitButton.addEventListener('click', function (e) {
               e.preventDefault();
               if (validator) {
                   validator.validate().then(function (status) {

                       if (status == 'Valid') {

                           Swal.fire({
                               title: 'Apa kamu yakin?',
                               text: "data akan tersimpan!",
                               icon: 'warning',
                               showCancelButton: true,
                               confirmButtonColor: '#3085d6',
                               cancelButtonColor: '#d33',
                               confirmButtonText: 'Ya, Simpan!',
                               cancelButtonText: 'Batal'
                           }).then((result) => {
                               if (result.isConfirmed) {
                                   var form = $('#formvalidation')[0];
                                   var data = new FormData(form);
                                   submitButton.setAttribute('data-kt-indicator', 'on');
                                   submitButton.disabled = true;
                                   setTimeout(function () {
                                       submitButton.removeAttribute('data-kt-indicator');
                                       submitButton.disabled = false;
                                       $.ajax({
                                           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                           type:'POST',
                                           url: `{{ route('register') }}`,
                                           data: data,
                                           contentType: false,
                                           processData: false,
                                           success:function(response)
                                           {
                                               Swal.fire({
                                                   title: response[0]['title'],
                                                   text: response[0]['message'],
                                                   icon: response[0]['icon'],
                                                   showConfirmButton: false,
                                                   timer: 2000,
                                                   timerProgressBar: true,
                                                   didOpen: () => {
                                                   },
                                                   willClose: () => {
                                                       if(response[0]['status'] == true){
                                                           window.location.assign(`{{ route('login') }}`)
                                                       } else {

                                                       }

                                                   }
                                               });
                                           },
                                           error: function(data) {
                                               var errors = data.responseJSON;
                                               console.log(errors)
                                               Swal.fire({
                                                   icon: 'error',
                                                   title: 'Oops...',
                                                   text: errors['message'],
                                               });
                                           }
                                       });
                                   }, 2000);
                               }
                           });
                       }
                   });
               }
           });
       }else{
           alert("form does not exists");
       }
   });
</script>
@stack('js')

</body>
<!--end::Body-->
</html>
