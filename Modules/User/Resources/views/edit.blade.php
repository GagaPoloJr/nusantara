<div class="modal-header">
    <h4 class="modal-title" id="topModalLabel">Ubah data User</h4>
    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
</div>
<div class="modal-body" id="form">
    <form id="formvalidation" class="form" action="#" autocomplete="off">
        <input id="user_id" type="hidden" name="user_id" value="{{ $user->user_id }}">
        <input id="type" type="hidden" name="type" value="update">
        <div class="fv-row mb-5">
            <label class="required fw-semibold fs-6 mb-2">Nama User</label>
            <input type="text" class="form-control" name="user_name" id="user_name" required="" value="{{ $user->user_name }}">
        </div>
        <div class="fv-row mb-5">
            <label class="required fw-semibold fs-6 mb-2">Email</label>
            <input type="email" class="form-control" name="email" id="email" required="" value="{{ $user->email }}">
        </div>
        <div class="fv-row mb-5">
            <label class="required fw-semibold fs-6 mb-5">Jenis Kelamin</label>
            <div class="form-check form-check-custom form-check-solid mb-2">
                <input class="form-check-input" type="radio" name="gender" value="L" id="gender" {{ ($user->gender=='L'?'checked':'') }}/>
                <label class="form-check-label">
                    Laki-laki
                </label>
            </div>
            <div class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="radio" name="gender" value="P" id="gender" {{ ($user->gender=='P'?'checked':'') }}/>
                <label class="form-check-label">
                    Perempuan
                </label>
            </div>
        </div>
        <div class="fv-row mb-5">
            <label class="required fw-semibold fs-6 mb-2">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="*****" oninput="this.value = this.value.toLowerCase()">
            <p class="text-muted font-13 mb-3">
                <code>Kosongkan</code> bagian ini apabila tidak ingin dirubah.
            </p>
        </div>
        <div class="fv-row mb-5">
            <label class="required fw-semibold fs-6 mb-2">Nomor Whatsapp</label>
            <input type="number" class="form-control" name="no_hp" id="no_hp" minlength="11" maxlength="15" required="" value="{{ $user->no_hp }}">
        </div>
        <div class="fv-row mb-5">
            <label class="required fw-semibold fs-6 mb-2">Foto</label>
            <input
                type="file"
                name="image"
                id="inputImage"
                accept="image/png, image/jpg, image/jpeg"
                class="form-control form-select-sm">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button id="submit" type="submit" class="btn btn-primary rounded-pill btn-sm">
        <span class="indicator-label">
            <i class="fa fa-save"></i>
            Simpan
        </span>
        <span class="indicator-progress">
            Tunggu Sebentar... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
        </span>
    </button>
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
                                                url: "{{ route('user.store') }}",
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
                                                                $("div#modal_default").modal('hide');
                                                                $('button#refresh').click();
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
    }, 1000);


</script>
