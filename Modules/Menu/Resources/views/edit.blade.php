<div class="modal-header">
    <h4 class="modal-title" id="topModalLabel">Ubah  Menu</h4>
    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
</div>
<div class="modal-body" id="form">
    <!--begin::Form-->
    <form id="formvalidation" class="form" action="#" autocomplete="off">
        <!--begin::Input group-->
        <input id="menu_id" type="hidden" name="menu_id" value="{{ $menu->menu_id }}">
        <div class="fv-row mb-5">
            <label for="menu_name" class="form-label">Nama  Menu * :</label>
            <input type="text" class="form-control" name="menu_name" id="menu_name" value="{{ $menu->menu_name }}">
        </div>
        <div class="fv-row mb-5">
            <label for="url" class="form-label">Url * :</label>
            <input type="text" class="form-control" name="url" id="url" value="{{ $menu->url }}">
        </div>
        <div class="fv-row mb-5">
            <label for="icon" class="form-label">Icon * :</label>
            <input type="text" class="form-control" name="icon" id="icon" value="{{ $menu->icon }}">
        </div>
        <div class="fv-row mb-5">
            <label for="main_menu" class="form-label">Main Menu * :</label>
            <input type="text" class="form-control" name="main_menu" id="main_menu" value="{{ $menu->main_menu }}">
        </div>
        <div class="fv-row mb-5">
            <label for="description" class="form-label">Role Menu * :</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ $menu->description }}">
        </div>
        <div class="fv-row mb-5">
            <label for="sort" class="form-label">Sort * :</label>
            <input type="text" class="form-control" name="sort" id="sort" value="{{ $menu->sort }}">
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
            if ($('form').length) {
                const form = document.getElementById('formvalidation');
                var validator = FormValidation.formValidation(
                    form, {
                        fields: {
                            'menu_name': {
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
                                            let menu_id = $("input#menu_id").val();
                                            $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                                , url: `{{ url('menu/') }}/${menu_id}`
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
