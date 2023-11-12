<!--begin::Tables Widget 9-->
<div class="card mb-5 mb-xl-8">
	<!--begin::Header-->
	<div class="card-header border-0 pt-5">
	   <h3 class="card-title align-items-start flex-column">
		  <span class="card-label fw-bolder fs-3 mb-1">Registrasi Kendaraan</span>
		  <span class="text-muted mt-1 fw-bold fs-7">5 Kendaraan Sudah Teregistrasi</span>
	   </h3>
	   <div class="card" data-bs-toggle="modal" data-bs-placement="top" data-bs-trigger="click" data-bs-target="#kt_modal_new_target">
		  <a href="#" class="btn btn-sm btn-light btn-active-primary">Registrasi</a>
		  <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
	   </div>
	</div>
	<!--end::Header-->
	<!--begin::Modal - New Target-->
	<div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
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
	<!--begin::Body-->
	<div class="card-body py-3">
	   <!--begin::Table container-->
	   <div class="table-responsive">
		  <!--begin::Table-->
		  <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
			 <!--begin::Table head-->
			 <thead>
				<tr class="fw-bolder text-muted">
				   <th class="w-25px">
					  <div class="form-check form-check-sm form-check-custom form-check-solid">
						 <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
					  </div>
				   </th>
				   <th class="min-w-150px">Nama Kendaraan</th>
				   <th class="min-w-140px">Nomor Polisi</th>
				   <th class="min-w-120px">Progress Pengecekan</th>
				   <th class="min-w-100px text-end">Actions</th>
				</tr>
			 </thead>
			 <!--end::Table head-->
			 <!--begin::Table body-->
			 <tbody>
				<tr>
				   <td>
					  <div class="form-check form-check-sm form-check-custom form-check-solid">
						 <input class="form-check-input widget-9-check" type="checkbox" value="1" />
					  </div>
				   </td>
				   <td>
					  <div class="d-flex align-items-center">
						 <div class="symbol symbol-45px me-5">
							<img src="{{ asset('assets/media/avatars/viar.jpg') }}" alt="" />
						 </div>
						 <div class="d-flex justify-content-start flex-column">
							<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">VIAR</a>
							<span class="text-muted fw-bold text-muted d-block fs-7">MT-0001</span>
						 </div>
					  </div>
				   </td>
				   <td>
					  <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">H 2118 QJ</a>
					  <span class="text-muted fw-bold text-muted d-block fs-7">Angkut Barang</span>
				   </td>
				   <td class="text-end">
					  <div class="d-flex flex-column w-100 me-2">
						 <div class="d-flex flex-stack mb-2">
							<span class="text-muted me-2 fs-7 fw-bold">50%</span>
						 </div>
						 <div class="progress h-6px w-100">
							<div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
						 </div>
					  </div>
				   </td>
				   <td>
					  <div class="d-flex justify-content-end flex-shrink-0">
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
							<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
								  <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
							<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
								  <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
							<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
								  <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
								  <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
					  </div>
				   </td>
				</tr>
				<tr>
				   <td>
					  <div class="form-check form-check-sm form-check-custom form-check-solid">
						 <input class="form-check-input widget-9-check" type="checkbox" value="1" />
					  </div>
				   </td>
				   <td>
					  <div class="d-flex align-items-center">
						 <div class="symbol symbol-45px me-5">
							<img src="{{ asset('assets/media/avatars/mitsubishi.jpg') }}" alt="" />
						 </div>
						 <div class="d-flex justify-content-start flex-column">
							<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">L 300</a>
							<span class="text-muted fw-bold text-muted d-block fs-7">MT-0002</span>
						 </div>
					  </div>
				   </td>
				   <td>
					  <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">H 8701 AE</a>
					  <span class="text-muted fw-bold text-muted d-block fs-7">Super Car</span>
				   </td>
				   <td class="text-end">
					  <div class="d-flex flex-column w-100 me-2">
						 <div class="d-flex flex-stack mb-2">
							<span class="text-muted me-2 fs-7 fw-bold">70%</span>
						 </div>
						 <div class="progress h-6px w-100">
							<div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
						 </div>
					  </div>
				   </td>
				   <td>
					  <div class="d-flex justify-content-end flex-shrink-0">
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
							<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
								  <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
							<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
								  <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
							<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
								  <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
								  <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
					  </div>
				   </td>
				</tr>
				<tr>
				   <td>
					  <div class="form-check form-check-sm form-check-custom form-check-solid">
						 <input class="form-check-input widget-9-check" type="checkbox" value="1" />
					  </div>
				   </td>
				   <td>
					  <div class="d-flex align-items-center">
						 <div class="symbol symbol-45px me-5">
							<img src="{{ asset('assets/media/avatars/toyota.jpg') }}" alt="" />
						 </div>
						 <div class="d-flex justify-content-start flex-column">
							<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">KIJANG</a>
							<span class="text-muted fw-bold text-muted d-block fs-7">MT-0003</span>
						 </div>
					  </div>
				   </td>
				   <td>
					  <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">H 8623 AE</a>
					  <span class="text-muted fw-bold text-muted d-block fs-7">Transportasi</span>
				   </td>
				   <td class="text-end">
					  <div class="d-flex flex-column w-100 me-2">
						 <div class="d-flex flex-stack mb-2">
							<span class="text-muted me-2 fs-7 fw-bold">60%</span>
						 </div>
						 <div class="progress h-6px w-100">
							<div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
						 </div>
					  </div>
				   </td>
				   <td>
					  <div class="d-flex justify-content-end flex-shrink-0">
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
							<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
								  <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
							<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
								  <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
							<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
								  <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
								  <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
					  </div>
				   </td>
				</tr>
				<tr>
				   <td>
					  <div class="form-check form-check-sm form-check-custom form-check-solid">
						 <input class="form-check-input widget-9-check" type="checkbox" value="1" />
					  </div>
				   </td>
				   <td>
					  <div class="d-flex align-items-center">
						 <div class="symbol symbol-45px me-5">
							<img src="{{ asset('assets/media/avatars/toyota.jpg') }}" alt="" />
						 </div>
						 <div class="d-flex justify-content-start flex-column">
							<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">KIJANG</a>
							<span class="text-muted fw-bold text-muted d-block fs-7">MT-0004</span>
						 </div>
					  </div>
				   </td>
				   <td>
					  <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">L 1631 G</a>
					  <span class="text-muted fw-bold text-muted d-block fs-7">Transportasi</span>
				   </td>
				   <td class="text-end">
					  <div class="d-flex flex-column w-100 me-2">
						 <div class="d-flex flex-stack mb-2">
							<span class="text-muted me-2 fs-7 fw-bold">50%</span>
						 </div>
						 <div class="progress h-6px w-100">
							<div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
						 </div>
					  </div>
				   </td>
				   <td>
					  <div class="d-flex justify-content-end flex-shrink-0">
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
							<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
								  <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
							<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
								  <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
							<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
								  <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
								  <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
					  </div>
				   </td>
				</tr>
				<tr>
				   <td>
					  <div class="form-check form-check-sm form-check-custom form-check-solid">
						 <input class="form-check-input widget-9-check" type="checkbox" value="1" />
					  </div>
				   </td>
				   <td>
					  <div class="d-flex align-items-center">
						 <div class="symbol symbol-45px me-5">
							<img src="{{ asset('assets/media/avatars/toyota.jpg') }}" alt="" />
						 </div>
						 <div class="d-flex justify-content-start flex-column">
							<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">AVANZA</a>
							<span class="text-muted fw-bold text-muted d-block fs-7">MT-0005</span>
						 </div>
					  </div>
				   </td>
				   <td>
					  <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">B 1286 UZA</a>
					  <span class="text-muted fw-bold text-muted d-block fs-7">Transportasi</span>
				   </td>
				   <td class="text-end">
					  <div class="d-flex flex-column w-100 me-2">
						 <div class="d-flex flex-stack mb-2">
							<span class="text-muted me-2 fs-7 fw-bold">90%</span>
						 </div>
						 <div class="progress h-6px w-100">
							<div class="progress-bar bg-info" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
						 </div>
					  </div>
				   </td>
				   <td>
					  <div class="d-flex justify-content-end flex-shrink-0">
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
							<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
								  <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
							<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
								  <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
						 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
							<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
							<span class="svg-icon svg-icon-3">
							   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								  <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
								  <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
								  <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
							   </svg>
							</span>
							<!--end::Svg Icon-->
						 </a>
					  </div>
				   </td>
				</tr>
			 </tbody>
			 <!--end::Table body-->
		  </table>
		  <!--end::Table-->
	   </div>
	   <!--end::Table container-->
	</div>
	<!--begin::Body-->
 </div>
 
 <!--begin::Post-->
	   <div class="card">
		  <!--begin::Card header-->
		  <div class="card-header border-0 pt-6">
			 <!--begin::Card title-->
			 <div class="card-title">
				<!--begin::Search-->
				<div class="d-flex align-items-center position-relative my-1">
				   <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
				   <span class="svg-icon svg-icon-1 position-absolute ms-6">
					  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						 <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
						 <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
					  </svg>
				   </span>
				   <!--end::Svg Icon-->
				   <input type="text" data-kt-subscription-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Masukan Id Kendaraan" />
				</div>
				<!--end::Search-->
			 </div>
			 <!--begin::Card title-->
			 <!--begin::Card toolbar-->
			 <div class="card-toolbar">
				<!--begin::Toolbar-->
				<div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
				   <!--begin::Filter-->
				   <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
				   <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
				   <span class="svg-icon svg-icon-2">
					  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						 <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
					  </svg>
				   </span>
				   <!--end::Svg Icon-->Filter</button>
				   <!--begin::Menu 1-->
				   <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
					  <!--begin::Header-->
					  <div class="px-7 py-5">
						 <div class="fs-5 text-dark fw-bolder">Filter Options</div>
					  </div>
					  <!--end::Header-->
					  <!--begin::Separator-->
					  <div class="separator border-gray-200"></div>
					  <!--end::Separator-->
					  <!--begin::Content-->
					  <div class="px-7 py-5" data-kt-subscription-table-filter="form">
						 <!--begin::Input group-->
						 <div class="mb-10">
							<label class="form-label fs-6 fw-bold">Month:</label>
							<select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-subscription-table-filter="month" data-hide-search="true">
							   <option></option>
							   <option value="jan">January</option>
							   <option value="feb">February</option>
							   <option value="mar">March</option>
							   <option value="apr">April</option>
							   <option value="may">May</option>
							   <option value="jun">June</option>
							   <option value="jul">July</option>
							   <option value="aug">August</option>
							   <option value="sep">September</option>
							   <option value="oct">October</option>
							   <option value="nov">November</option>
							   <option value="dec">December</option>
							</select>
						 </div>
						 <!--end::Input group-->
						 <!--begin::Input group-->
						 <div class="mb-10">
							<label class="form-label fs-6 fw-bold">Status:</label>
							<select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-subscription-table-filter="status" data-hide-search="true">
							   <option></option>
							   <option value="Active">Active</option>
							   <option value="Suspended">Suspended</option>
							</select>
						 </div>
						 <!--end::Input group-->
						 <!--begin::Input group-->
						 <div class="mb-10">
							<label class="form-label fs-6 fw-bold">Petugas:</label>
							<select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-subscription-table-filter="billing" data-hide-search="true">
							   <option></option>
							   <option value="Petugas 1">Catur Sugi Ade K</option>
							   <option value="Petugas 2">Ramdhan Miftahul Rahmad</option>
							   <option value="Petugas 3">Rangga Permana Putra</option>
							   <option value="Petugas 4">Petugas Piket</option>
							</select>
						 </div>
						 <!--end::Input group-->
						 <!--begin::Actions-->
						 <div class="d-flex justify-content-end">
							<button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="reset">Reset</button>
							<button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="filter">Apply</button>
						 </div>
						 <!--end::Actions-->
					  </div>
					  <!--end::Content-->
				   </div>
				   <!--end::Menu 1-->
				   <!--end::Filter-->
				   <!--begin::Export-->
				   <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_subscriptions_export_modal">
				   <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
				   <span class="svg-icon svg-icon-2">
					  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						 <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
						 <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
						 <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
					  </svg>
				   </span>
				   <!--end::Svg Icon-->Export</button>
				   <!--end::Export-->
				   <!--begin::Add subscription-->
				   <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_subscriptions_export">
					  <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
					  <span class="svg-icon svg-icon-2">
						 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
							<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
						 </svg>
					  </span>
					  <!--end::Svg Icon-->Tambahkan Jenis Pengecekan</button>
				</div>
				<!--end::Toolbar-->
				<!--begin::Group actions-->
				<div class="d-flex justify-content-end align-items-center d-none" data-kt-subscription-table-toolbar="selected">
				   <div class="fw-bolder me-5">
				   <span class="me-2" data-kt-subscription-table-select="selected_count"></span>Selected</div>
				   <button type="button" class="btn btn-danger" data-kt-subscription-table-select="delete_selected">Delete Selected</button>
				</div>
				<!--end::Group actions-->
			 </div>
			 <!--end::Card toolbar-->
		  </div>
		  <!--end::Card header-->
		  
		  <!--begin::Card body-->
		  <div class="card-body pt-0">
			 <!--begin::Table-->
			 <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_subscriptions_table">
				<!--begin::Table head-->
				<thead>
				   <!--begin::Table row-->
				   <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
					  <th class="w-10px pe-2">
						 <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
							<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_subscriptions_table .form-check-input" value="1" />
						 </div>
					  </th>
					  <th class="min-w-125px">Jenis Pengecekan</th>
					  <th class="min-w-125px">Status</th>
					  <th class="min-w-125px">Petugas</th>
					  <th class="min-w-125px">Tanggal Pengecekan</th>
					  <th class="min-w-125px">Actions</th>
				   </tr>
				   <!--end::Table row-->
				</thead>
				<!--end::Table head-->
				<!--begin::Table body-->
				<tbody class="text-gray-600 fw-bold">
				   <tr>
					  <!--begin::Checkbox-->
					  <td>
						 <div class="form-check form-check-sm form-check-custom form-check-solid">
							<input class="form-check-input" type="checkbox" value="1" />
						 </div>
					  </td>
					  <!--end::Checkbox-->
					  <!--begin::Customer=-->
					  <td>
						 <a href="#" class="text-gray-800 text-hover-primary mb-1">Roda Depan</a>
					  </td>
					  <!--end::Customer=-->
					  <!--begin::Status=-->
					  <td>
						 <div class="badge badge-light-success">Active</div>
					  </td>
					  <!--end::Status=-->
					  <!--begin::Product=-->
					  <td>Sugi Ade K</td>
					  <!--end::Product=-->
					  <!--begin::Date=-->
					  <td>Jun 24, 2021</td>
					  <!--end::Date=-->
					  <!--begin::Action=-->
					  <td>
						 <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
						 <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
						 <span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							   <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						 </span>
						 <!--end::Svg Icon--></a>
						 <!--begin::Menu-->
						 <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
							<!--begin::Menu item-->
							<div class="menu-item px-3">
							   <a href="#" class="menu-link px-3">Baik</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
							   <a href="#" class="menu-link px-3">Tidak Baik</a>
							</div>
							<!--end::Menu item-->
						 </div>
						 <!--end::Menu-->
					  </td>
					  <!--end::Action=-->
				   </tr>
				   <tr>
					  <!--begin::Checkbox-->
					  <td>
						 <div class="form-check form-check-sm form-check-custom form-check-solid">
							<input class="form-check-input" type="checkbox" value="1" />
						 </div>
					  </td>
					  <!--end::Checkbox-->
					  <!--begin::Customer=-->
					  <td>
						 <a href="#" class="text-gray-800 text-hover-primary mb-1">Roda Belakang</a>
					  </td>
					  <!--end::Customer=-->
					  <!--begin::Status=-->
					  <td>
						 <div class="badge badge-light-success">Active</div>
					  </td>
					  <!--end::Status=-->
					  <!--begin::Product=-->
					  <td>Sugi Ade K</td>
					  <!--end::Product=-->
					  <!--begin::Date=-->
					  <td>Jun 24, 2021</td>
					  <!--end::Date=-->
					  <!--begin::Action=-->
					  <td>
						 <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
						 <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
						 <span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							   <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						 </span>
						 <!--end::Svg Icon--></a>
						 <!--begin::Menu-->
						 <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
							<!--begin::Menu item-->
							<div class="menu-item px-3">
							   <a href="#" class="menu-link px-3">Baik</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
							   <a href="#" class="menu-link px-3">Tidak Baik</a>
							</div>
							<!--end::Menu item-->
						 </div>
						 <!--end::Menu-->
					  </td>
					  <!--end::Action=-->
				   </tr>
				</tbody>
				<!--end::Table body-->
			 </table>
			 <!--end::Table-->
		  </div>
		  <!--end::Card body-->
	   </div>
	   <!--end::Card-->
	   <!--begin::Modals-->
	   <!--begin::Modal - Adjust Balance-->
	   <div class="modal fade" id="kt_subscriptions_export_modal" tabindex="-1" aria-hidden="true">
		  <!--begin::Modal dialog-->
		  <div class="modal-dialog modal-dialog-centered mw-650px">
			 <!--begin::Modal content-->
			 <div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header">
				   <!--begin::Modal title-->
				   <h2 class="fw-bolder">Export Dokumen</h2>
				   <!--end::Modal title-->
				   <!--begin::Close-->
				   <div id="kt_subscriptions_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
				<!--end::Modal header-->
				<!--begin::Modal body-->
				<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
				   <!--begin::Form-->
				   <form id="kt_subscriptions_export_form" class="form" action="#">
					  <!--begin::Input group-->
					  <div class="fv-row mb-10">
						 <!--begin::Label-->
						 <label class="fs-5 fw-bold form-label mb-5">Select Date Range:</label>
						 <!--end::Label-->
						 <!--begin::Input-->
						 <input class="form-control form-control-solid" placeholder="Pick a date" name="date" />
						 <!--end::Input-->
					  </div>
					  <!--end::Input group-->
					  <!--begin::Input group-->
					  <div class="fv-row mb-10">
						 <!--begin::Label-->
						 <label class="fs-5 fw-bold form-label mb-5">Select Export Format:</label>
						 <!--end::Label-->
						 <!--begin::Input-->
						 <select data-control="select2" data-placeholder="Select a format" data-hide-search="true" name="format" class="form-select form-select-solid">
							<option value="excell">Excel</option>
							<option value="pdf">PDF</option>
							<option value="cvs">CVS</option>
							<option value="zip">ZIP</option>
						 </select>
						 <!--end::Input-->
					  </div>
					  <!--end::Input group-->
					  <!--begin::Actions-->
					  <div class="text-center">
						 <button type="reset" id="kt_subscriptions_export_cancel" class="btn btn-light me-3">Discard</button>
						 <button type="submit" id="kt_subscriptions_export_submit" class="btn btn-primary">
							<span class="indicator-label">Submit</span>
							<span class="indicator-progress">Please wait...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						 </button>
					  </div>
					  <!--end::Actions-->
				   </form>
				   <!--end::Form-->
				</div>
				<!--end::Modal body-->
			 </div>
			 <!--end::Modal content-->
		  </div>
		  <!--end::Modal dialog-->
	   </div>
 
	   <div class="modal fade" id="kt_subscriptions_export" tabindex="-1" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered mw-650px">
			 <!--begin::Modal content-->
			 <div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header">
				   <!--begin::Modal title-->
				   <h2 class="fw-bolder">Tambah Jenis Pengecekan</h2>
				   <!--end::Modal title-->
				   <!--begin::Close-->
				   <div id="kt_subscriptions_export" class="btn btn-icon btn-sm btn-active-icon-primary">
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
				<!--end::Modal header-->
				<!--begin::Modal body-->
				<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
				   <!--begin::Form-->
				   <form id="#kt_subscriptions_export" class="form" action="#">
					  <!--begin::Input group-->
					  <div class="fv-row mb-10">
						 <!--begin::Label-->
						 <label class="fs-5 fw-bold form-label mb-5">Select Date Range:</label>
						 <!--end::Label-->
						 <!--begin::Input-->
						 <input class="form-control form-control-solid" placeholder="Pick a date" name="date" />
						 <!--end::Input-->
					  </div>
					  <!--end::Input group-->
					  <!--begin::Actions-->
					  <div class="text-center">
						 <button type="reset" id="kt_subscriptions_export_cancel" class="btn btn-light me-3">Discard</button>
						 <button type="submit" id="kt_subscriptions_export_submit" class="btn btn-primary">
							<span class="indicator-label">Submit</span>
							<span class="indicator-progress">Please wait...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						 </button>
					  </div>
					  <!--end::Actions-->
				   </form>
				   <!--end::Form-->
				</div>
				<!--end::Modal body-->
			 </div>
			 <!--end::Modal content-->
		  </div>
	   </div>
	   <!--end::Modal - New Card-->
	   <!--end::Modals-->
 <!--end::Post-->