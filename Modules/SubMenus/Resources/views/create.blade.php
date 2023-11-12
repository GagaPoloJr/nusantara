<div class="modal-header">
    <h4 class="modal-title" id="topModalLabel">Tambah Menu</h4>
    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
</div>
<div class="modal-body" id="form">
    <form id="formvalidation" class="form" action="#" autocomplete="off">
        <div class="fv-row mb-5">
            <label for="sub_menu_name" class="form-label">Nama Sub Menu * :</label>
            <input type="text" class="form-control" name="sub_menu_name" id="sub_menu_name">
        </div>
        <div class="fv-row mb-5">
            <label for="url" class="form-label">Url * :</label>
            <input type="text" class="form-control" name="url" id="url">
        </div>
        <div class="fv-row mb-5">
            <label for="menu_id" class="form-label">Menu Parent * :</label>
            <select class="form-select" name="menu_id" data-control="select2" data-dropdown-parent="#modal_default" data-placeholder="Pilih Menu Parent" id="menu_id">
                <option disabled> -- Pilih parent menu --</option>
                @foreach($menus as $menu)
                <option value="{{ $menu->menu_id }}">{{ $menu->menu_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="fv-row mb-5">
            <label for="sort" class="form-label">Sort Menu :</label>
            <input type="text" class="form-control" name="sort" id="sort">
        </div>
        </button>
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
    var blockUI = new KTBlockUI(document.querySelector('#form'), {
        message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Harap Tunggu...</div>'
    , });
    blockUI.block();
    $.holdReady(true);

    const message = {
        required: 'Tidak boleh kosong'
    }
    const validation = {
        'sub_menu_name': {
            validators: {
                notEmpty: {
                    message: message.required
                }
            }
        }
        , 'url': {
            validators: {
                notEmpty: {
                    message: message.required
                }
            }
        }
        , 'menu_id': {
            validators: {
                notEmpty: {
                    message: message.required
                }
            }
        },

    }

    setTimeout(function() {
        $.holdReady(false);
        $(document).ready(function() {
            blockUI.release();
            if ($('form').length) {
                const form = document.getElementById('formvalidation');
                var validator = FormValidation.formValidation(
                    form, {
                        fields: validation
                        , plugins: {
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
                                            $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                                , url: "{{ route('submenu.store') }}"
                                                , type: "POST"
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
                alert("form does not exists");
            }
        });
    }, 500);

</script>
