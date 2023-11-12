<div class="modal-header">
    <h4 class="modal-title" id="topModalLabel">Tambah Kamus</h4>
    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
</div>
<div class="modal-body" id="form">
    <form id="formvalidation" class="form" action="#" autocomplete="off">
        <div class="fv-row mb-5">
            <label for="dictionary_name" class="form-label">Kode Kamus * :</label>
            <input type="text" class="form-control" name="dictionary_id" id="dictionary_id" required="">
        </div>
        <div class="fv-row mb-5">
            <label for="dictionary_name" class="form-label">Nama Kamus * :</label>
            <input type="text" class="form-control" name="dictionary_name" id="dictionary_name" required="">
        </div>
        <div class="fv-row mb-5">
            <label for="dictionary_name" class="form-label">Kunci * :</label>
            <input type="text" class="form-control" name="key" id="key" required="">
        </div>
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
        message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Harap Tunggu...</div>',
    });
    blockUI.block();
    $.holdReady(true);

    setTimeout(function () {
        $.holdReady(false);
        $(document).ready(function() {
            blockUI.release();
            if($('form').length){
                const form = document.getElementById('formvalidation');
                var validator = FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            'dictionary_id': {
                                validators: {
                                    notEmpty: {
                                        message: 'Tidak boleh kosong'
                                    }
                                }
                            },
                            'dictionary_name': {
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
                                        submitButton.setAttribute('data-kt-indicator', 'on');
                                        submitButton.disabled = true;
                                        setTimeout(function () {
                                            submitButton.removeAttribute('data-kt-indicator');
                                            submitButton.disabled = false;
                                            $.ajax({
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                url: "{{ route('dictionary.store') }}",
                                                type: "POST",
                                                data: $('#formvalidation').serialize(),
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
                alert("form does not exists");
            }
        });
    }, 500);


</script>
