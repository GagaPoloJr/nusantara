  <!--begin::Modal - New Target-->
  <div class="modal fade kt_modal_new_target" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
      <!--begin::Modal dialog-->
      <div class="modal-dialog modal-dialog-centered mw-650px">
          <!--begin::Modal content-->
          <div class="modal-content rounded">
              <!--begin::Modal header-->
              <div class="modal-header pb-0 border-0 justify-content-end">
                  <!--begin::Close-->
                  <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                      <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                      <span class="svg-icon svg-icon-1">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                              <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                          </svg>
                      </span>
                      <!--end::Svg Icon-->
                  </div>
                  <!--end::Close-->
              </div>
              <!--begin::Modal header-->
              <!--begin::Modal body-->
              <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                  <!--begin:Form-->
                  <form id="kt_modal_new_target_form" class="form" action="#">
                      <!--begin::Heading-->
                      <div class="mb-13 text-center">
                          <!--begin::Title-->
                          <h1 class="mb-3">Masukan Data Kendaraan</h1>
                          <!--end::Title-->
                          <!--begin::Description-->
                          <!--end::Description-->
                      </div>
                      <!--end::Heading-->
                      <!--begin::Input group-->
                      <div class="d-flex flex-column mb-8">
                          <label class="fs-6 fw-bold mb-2">Nama Kendaraan</label>
                          <textarea class="form-control form-control-solid" rows="1" name="target_details" placeholder="Masukan nama kendaraan"></textarea>
                      </div>
                      <!--end::Input group-->
                      <!--begin::Input group-->
                      <div class="d-flex flex-column mb-8">
                          <label class="fs-6 fw-bold mb-2">ID Kendaraan</label>
                          <textarea class="form-control form-control-solid" rows="1" name="target_details" placeholder="Otomatis" disabled></textarea>
                      </div>
                      <!--end::Input group-->
                      <!--begin::Input group-->
                      <div class="row 4-9 mb-4">
                          <div class="col-md-6 fv-row">
                              <label class="fs-6 fw-bold mb-2">Nomor Polisi</label>
                              <textarea class="form-control form-control-solid" rows="1" name="Masukan No Polisi" placeholder="Masukan No Polisi"></textarea>
                          </div>
                      </div>
                      <!--end::Input group-->
                      <!--begin::Input group-->
                      <div class="row g-9 mb-8">
                          <!--begin::Col-->
                          <div class="col-md-6 fv-row">
                              <label class="required fs-6 fw-bold mb-2">Jenis Kendaraan</label>
                              <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kendaraan" name="target_assign">
                                  <option value="">Pilih jenis..</option>
                                  <option value="1">Tranpostasi</option>
                                  <option value="2">Angkut Barang</option>
                                  <option value="3">Super Car</option>

                              </select>
                          </div>
                          <!--end::Col-->
                      </div>
                      <!--end::Input group-->
                      <!--begin::Actions-->
                      <div class="text-center">
                          <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
                          <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                              <span class="indicator-label">Submit</span>
                              <span class="indicator-progress">Please wait...
                                  <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                          </button>
                      </div>
                      <!--end::Actions-->
                  </form>
                  <!--end:Form-->
              </div>
              <!--end::Modal body-->
          </div>
          <!--end::Modal content-->
      </div>
      <!--end::Modal dialog-->
  </div>
  <!--end::Modal - New Target-->


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
