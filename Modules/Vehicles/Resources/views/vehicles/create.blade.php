  <div class="modal-header">
      <h4 class="modal-title" id="topModalLabel">Masukan Data Kendaraan</h4>
      <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
  </div>
  <div class="modal-body" id="form">
      <form id="formvalidation" class="form" action="#" autocomplete="off">
          <div class="fv-row mb-5">
              <label for="vehicle_name" class="form-label">Nama Kendaraan * :</label>
              <input type="text" class="form-control" name="vehicle_name" id="vehicle_name">
          </div>
          <div class="fv-row mb-5">
              <label for="vehicle_code" class="form-label">ID Kendaraan * :</label>
              <input type="text" class="form-control" name="vehicle_code" id="vehicle_code" placeholder="Otomatis" disabled>
          </div>
          <div class="fv-row mb-5">
              <label for="vehicle_category" class="form-label">Kategori Kendaraan * :</label>
              <select class="form-select" name="vehicle_category" data-control="select2" data-dropdown-parent="#modal_default" data-placeholder="Pilih Menu Parent" id="vehicle_category">
                  <option disabled> -- Pilih kategori --</option>
                  @foreach($categories as $category)
                  <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="fv-row mb-5">
              <label for="vehicle_number" class="form-label">Nomor Polisi * :</label>
              <input type="text" class="form-control" name="vehicle_number" id="vehicle_number">
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
                      // Access the globally defined vehicleDatatable
                      var vehicleDatatable = window.vehicleDatatable;
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
                                                  , url: "{{ route('vehicles.store') }}"
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
                                                      $('table#vehicle_datatable').DataTable().ajax.reload();
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
