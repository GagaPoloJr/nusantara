<div class="modal-header">
    <h4 class="modal-title" id="topModalLabel">Tambah Jenis Pengecekan</h4>
    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
</div>
<div class="modal-body" id="form">
    <form id="formvalidation" class="form" action="#" autocomplete="off">
        <!--begin::Input group-->
        <div class="fv-row mb-5">
            <label class="required fw-semibold fs-6 mb-2">Jenis Pengecekan</label>
            <input hidden id="vehicle_code" name="vehicle_code" type="text">
            <select class="form-select form-select-md mb-3" data-placeholder="Pilih Jenis Pengecekan..." data-dropdown-parent="#modal_default" data-allow-clear="true" id="select_company" name="form_id">
                <option></option>
                @foreach($forms as $form)
                <option data-kt-select2-company="{{ asset('') }}metronic/media/flags/aland-islands.svg" value="{{ $form->form_id }}" data-kt-select2-group="{{ asset('') }}metronic/media/flags/afghanistan.svg">{{ $form->form_name }}</option>
                @endforeach
            </select>

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
        message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Harap Tunggu...</div>'
    , });
    blockUI.block();
    $.holdReady(true);
    setTimeout(function() {
        $.holdReady(false);
        $(document).ready(function() {
            blockUI.release();



            // get the query code
            const vehicleCode = $('#vehicle_code');
            let urlParams = new URLSearchParams(window.location.search);
            let initialQuery = urlParams.get('code')
            vehicleCode.val(initialQuery);


            if ($('form').length) {
                $('select#select_company').select2();
                const form = document.getElementById('formvalidation');
                var validator = FormValidation.formValidation(
                    form, {
                        fields: {
                            'company_id': {
                                validators: {
                                    notEmpty: {
                                        message: 'Tidak boleh kosong'
                                    }
                                }
                            }
                            , 'company_name': {
                                validators: {
                                    notEmpty: {
                                        message: 'Tidak boleh kosong'
                                    }
                                }
                            }
                        , },

                        plugins: {
                            trigger: new FormValidation.plugins.Trigger()
                            , bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row'
                                , eleInvalidClass: ''
                                , eleValidClass: ''
                            })
                        }
                    }
                );
                const submitButton = document.getElementById('submit');
                submitButton.addEventListener('click', function(e) {
                    e.preventDefault()
                    if (validator) {
                        validator.validate().then(function(status) {
                            if (status == 'Valid') {
                                Swal.fire({
                                    title: 'Apa kamu yakin?'
                                    , text: "data akan tersimpan!"
                                    , icon: 'warning'
                                    , showCancelButton: true
                                    , confirmButtonColor: '#3085d6'
                                    , cancelButtonColor: '#d33'
                                    , confirmButtonText: 'Ya, Simpan!'
                                    , cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        submitButton.setAttribute('data-kt-indicator', 'on');
                                        submitButton.disabled = true;
                                        setTimeout(function() {
                                            submitButton.removeAttribute('data-kt-indicator');
                                            submitButton.disabled = false;
                                            $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                                , url: "{{ route('checklist.store') }}"
                                                , type: "POST"
                                                , data: $('form#formvalidation').serialize()
                                                , success: function(response) {
                                                    Swal.fire({
                                                        title: 'Berhasil'
                                                        , text: response
                                                        , icon: 'success'
                                                        , showConfirmButton: false
                                                        , timer: 2000
                                                        , timerProgressBar: true
                                                        , didOpen: () => {}
                                                        , willClose: () => {
                                                            $("div#modal_default").modal('hide');
                                                            $('button#refresh').click();
                                                        }
                                                    });
                                                }
                                                , error: function(data) {
                                                    var errors = data.responseJSON;
                                                    console.log(errors)
                                                    Swal.fire({
                                                        icon: 'error'
                                                        , title: 'Oops...'
                                                        , text: errors['message']
                                                    , });
                                                }
                                            });
                                        }, 2000);
                                    }
                                });
                            }
                        });
                    }
                });
            } else {
                alert("Tidak tersedia");
            }
        });
    }, 500);

</script>
