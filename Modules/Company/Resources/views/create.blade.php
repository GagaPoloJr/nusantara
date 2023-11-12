<div class="modal-header">
    <h4 class="modal-title" id="topModalLabel">Tambah Perusahaan</h4>
    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
</div>
<div class="modal-body" id="form">
    <form id="formvalidation" class="form" action="#" autocomplete="off">
        <!--begin::Input group-->
        <div class="fv-row mb-5">
            <label class="required fw-semibold fs-6 mb-2">Kode Perusahaan</label>
            <input type="text" class="form-control" name="company_id" id="company_id">
        </div>
        <div class="fv-row mb-5">
            <label class="required fw-semibold fs-6 mb-2">Nama Perusahaan</label>
            <input type="text" class="form-control" name="company_name" id="company_name">
        </div>
        <div class="fv-row mb-5">
            <label class="required fw-semibold fs-6 mb-2">Induk Perusahaan</label>
            <select class="form-select form-select-md mb-3" data-placeholder="Pilih Perusahaan Induk..." data-dropdown-parent="#modal_default" data-allow-clear="true" id="select_company" name="parent">
                <option></option>
                @foreach($companys as $company)
                    <option data-kt-select2-company="{{ asset('') }}metronic/media/flags/aland-islands.svg" value="{{ $company->company_id }}" data-kt-select2-group="{{ asset('') }}metronic/media/flags/afghanistan.svg">{{ $company->company_id }}</option>
                @endforeach
            </select>
            <p class="text-muted font-13">
                <code>Kosongkan</code> bagian ini apabila perusahaan adalah induk.
            </p>
        </div>
        <!--end::Input group-->
    </form>
</div>
<div class="modal-footer">
    <!--begin::Actions-->
    <button id="submit" type="submit" class="btn btn-primary rounded-pill btn-sm">
        <span class="indicator-label">
            <i class="fa fa-save"></i>
            Simpan
        </span>
        <span class="indicator-progress">
            Tunggu Sebentar... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
        </span>
    </button>
    <!--end::Actions-->
</div>

<script>
    var blockUI = new KTBlockUI(document.querySelector('div#form'), {
        message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Harap Tunggu...</div>',
    });
    blockUI.block();
    $.holdReady(true);
    setTimeout(function () {
        $.holdReady(false);
        $(document).ready(function() {
            blockUI.release();
            if($('form').length){
                $('select#select_company').select2();
                const form = document.getElementById('formvalidation');
                var validator = FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            'company_id': {
                                validators: {
                                    notEmpty: {
                                        message: 'Tidak boleh kosong'
                                    }
                                }
                            },
                            'company_name': {
                                validators: {
                                    notEmpty: {
                                        message: 'Tidak boleh kosong'
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
                    e.preventDefault()
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
                                        submitButton.setAttribute('data-kt-indicator', 'on');
                                        submitButton.disabled = true;
                                        setTimeout(function () {
                                            submitButton.removeAttribute('data-kt-indicator');
                                            submitButton.disabled = false;
                                            $.ajax({
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                url: "{{ route('company.store') }}",
                                                type: "POST",
                                                data: $('form#formvalidation').serialize(),
                                                success:function(response)
                                                {
                                                    Swal.fire({
                                                        title: 'Berhasil',
                                                        text: response,
                                                        icon: 'success',
                                                        showConfirmButton: false,
                                                        timer: 2000,
                                                        timerProgressBar: true,
                                                        didOpen: () => {
                                                        },
                                                        willClose: () => {
                                                            $("div#modal_default").modal('hide');
                                                            $('button#refresh').click();
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
                alert("Tidak tersedia");
            }
        });
    }, 500);
</script>
