<div class="modal-header">
    <h4 class="modal-title" id="topModalLabel">Ubah Data Kendaraan - {{ $vehicle->vehicle_code }}</h4>
    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
</div>
<div class="modal-body" id="form">
    <!--begin::Form-->
    <form id="formvalidation" class="form" action="#" autocomplete="off">
        <!--begin::Input group-->
        <input id="vehicle_id" type="hidden" name="vehicle_id" value="{{ $vehicle->vehicle_id }}">
        <div class="fv-row mb-5">
            <label for="vehicle_name" class="form-label">Nama Kendaraan * :</label>
            <input type="text" class="form-control" name="vehicle_name" id="vehicle_name" value="{{ $vehicle->vehicle_name }}">
        </div>
       
        <div class="fv-row mb-5">
            <label for="key" class="form-label">Kategori Kendaraan * :</label>
            <select class="form-select" name="category_id" data-control="select2" data-dropdown-parent="#modal_default" data-placeholder="Pilih Category" id="category_id">
                <option disabled> -- Pilih cateogry --</option>
                @foreach($vehicle_category as $category)
                <option {{ $vehicle->vehicleCategory->name === $category->name ? 'selected' : '' }} value="{{ $category->category_id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="fv-row mb-5">
            <label for="vehicle_number" class="form-label">Nomor Polisi * :</label>
            <input  type="text" class="form-control" name="vehicle_number" id="vehicle_number" value="{{ $vehicle->vehicle_number }}">
        </div>
        <!--end::Input group-->

    </form>
    <!--end::Form-->
</div>
<div class="modal-footer">
    <!--begin::Actions-->
    <button id="submit" type="submit" class="btn btn-primary rounded-pill btn-sm">
        <span class="indicator-label">
            <i class="fa fa-save"></i>
            Update
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
            if ($('form').length) {
                const form = document.getElementById('formvalidation');

                const message = {
                    required: 'Tidak boleh kosong'
                }
                const validation = {
                    'vehicle_name': {
                        validators: {
                            notEmpty: {
                                message: message.required
                            }
                        }
                    }
                    , 'vehicle_number': {
                        validators: {
                            notEmpty: {
                                message: message.required
                            }
                        }
                    },

                }

                var validator = FormValidation.formValidation(
                    form, {
                        fields: validation,
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
                    e.preventDefault();
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
                                            let vehicle_id = $("input#vehicle_id").val();
                                            $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                                , url: `{{ url('vehicles/') }}/${vehicle_id}`
                                                , type: "PUT"
                                                , data: $('#formvalidation').serialize()
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
                alert("form does not exists");
            }
        });
    }, 500);

</script>
