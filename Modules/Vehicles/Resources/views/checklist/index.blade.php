@extends('vehicles::layouts.master')

@push('css')
<style>
    .clickable {
        cursor: pointer;
    }

    .card-deck {
        max-height: 200px;
        overflow-y: scroll;
        background: #fff;
    }

</style>
@endpush
@section('container')


<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  pt-6 pb-2 ">
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container  container-fluid ">
                <div class="card card-custom card-stretch shadow">
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
                                    <div class="position-relative">
                                        <input id="searchInput" type="text" data-kt-subscription-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Masukan Id Kendaraan" />
                                        <div id="searchResults" class="card-deck mt-5 shadow-sm position-absolute w-100" style="display: none;"></div>
                                    </div>
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base" data-bs-placement="top">
                                    <!--begin::Filter-->
                                    <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
                                                <path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293V3.5zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z" />
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
                                                <label class="form-label fs-6 fw-bold">Bulan:</label>
                                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih bulan" data-allow-clear="true" data-kt-subscription-table-filter="month" data-hide-search="true">
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
                                                <label class="form-label fs-6 fw-bold">Petugas:</label>
                                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih petugas" data-allow-clear="true" data-kt-subscription-table-filter="billing" data-hide-search="true">
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
                                                <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="filter">Search</button>
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
                                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#modal_default" id="btn_add">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        Tambahkan Jenis Pengecekan</button>
                                </div>
                                <div style="display: none" class="col-sm-8">
                                    <div class="text-sm-end mt-2 mt-sm-0">
                                        <button type="button" class="btn btn-primary btn-sm float-end me-4 rounded-pill" id="refresh"><i class="fa fa-refresh"></i> Segarkan</button>
                                    </div>
                                </div><!-- end col-->
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
                        <div id="resultVehicles" class="card-body p-10">
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table id="checklist_datatable" class="table align-middle table-row-dashed fs-6 gy-5">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        {{-- <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_subscriptions_table .form-check-input" value="1">
                                            </div>
                                        </th> --}}
                                        <th>No.</th>
                                        <th class="min-w-185px">Jenis Pengecekan</th>
                                        <th class="min-w-125px">Petugas</th>
                                        <th class="min-w-125px">Tanggal Pengecekan</th>
                                        <th class="min-w-195px">Keterangan</th>
                                        <th class="min-w-195px">Status</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                    <tr class="text-center">
                                        <td>Data tidak ditemukan...</td>
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
                                            <label class="fs-5 fw-bold form-label mb-5">Pilih Format:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select id="exportFormat" data-control="select2" data-placeholder="Select a format" data-hide-search="true" name="format" class="form-select form-select-solid">
                                                <option value=""></option>
                                                <option value="pdf">PDF</option>
                                                {{-- <option value="cvs">CVS</option>
                                                <option value="zip">ZIP</option> --}}
                                            </select>
                                            <!--end::Input-->
                                            <!--end::Input group-->
                                        </div>
                                        <!--begin::Actions-->
                                        <div class="text-center">
                                            <button type="reset" id="kt_subscriptions_export_cancel" class="btn btn-light me-3">Batal</button>
                                            <button type="button" data-code="" id="export_data" class="btn btn-primary">
                                                <span class="indicator-label">Download</span>
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


                    <!--end::Modal - New Card-->
                    <!--end::Modals-->
                    <!--end::Post-->
                    <!--begin::Card footer-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button class="btn btn-light btn-active-light-primary me-2">Batal</button>
                        <button id="submit_progress" class="btn btn-primary">Simpan Progres</button>
                    </div>
                    <!--end::Card footer-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push('js')
<script>
    $(document).ready(function() {
        const searchInput = $('#searchInput');
        const resultsContainer = $('#searchResults');
        const resultPopulate = $('#resultVehicles');
        var initialData = [];



        // Perform the initial search
        performSearch();

        function performSearch() {
            // // Get the query parameter from the URL
            let urlParams = new URLSearchParams(window.location.search);
            let initialQuery = urlParams.get('code')
            searchInput.val(initialQuery);


            if (!initialQuery) return;


            $.ajax({
                type: 'POST'
                , url: `{{ route('search.vehicles') }}`
                , data: {
                    '_token': '{{ csrf_token() }}'
                    , 'query': initialQuery
                }
                , success: function(data) {
                    displayResults(data);
                    console.log(data)
                    generateLinkExport(data[0].vehicle_code)

                }
            });
        }

        searchInput.on('input', function() {
            let query = $(this).val();

            $.ajax({
                type: 'POST'
                , url: `{{ route('search.vehicles') }}`
                , data: {
                    '_token': '{{ csrf_token() }}'
                    , 'query': query
                }
                , success: function(data) {
                    displayResults(data);
                    generateLinkExport(data[0].vehicle_code)

                }
            })
        })

        function updateUrl(query, id) {
            const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?code=' + encodeURIComponent(query) + '&id=' + encodeURIComponent(id);
            window.history.replaceState({
                path: newUrl
            }, '', newUrl);
            generateLinkExport(query)
        }

        function displayResults(results) {
            const resultsContainer = $('#searchResults');
            const buttonTambah = $('#btn_add');
            resultsContainer.empty();
            buttonTambah.hide();

            if (results.length === 0) {
                resultsContainer.append('<div class="card"><div class="card-body">No results found</div></div>');
            } else {
                $.each(results, function(index, result) {
                    let resultItem = `
                        <div style="border-bottom: 1px solid #f0f0f0;" class="clickable" data-vehicle-id="${result.vehicle_id}" data-vehicle-number="${result.vehicle_number}" data-vehicle-name="${result.vehicle_name}" data-vehicle-code="${result.vehicle_code}">
                        <div style="padding:1rem 2rem" class="card-body"> 
                        <h5 class="card-title">${result.vehicle_name}</h5> 
                        <p class="card-text">${result.vehicle_code}</p> 
                        </div></div>
                    `;
                    resultItem = $(resultItem);
                    resultItem.on('click', function() {
                        populateResultData($(this).data('vehicle-name'), $(this).data('vehicle-code'), $(this).data('vehicle-number'));
                        updateUrl($(this).data('vehicle-code'), $(this).data('vehicle-id'));
                        resultsContainer.hide();
                        buttonTambah.show();
                        checkListData(result.vehicle_code)
                        generateLinkExport(result.vehicle_code)

                    });

                    resultsContainer.append(resultItem)


                });
            }

            //show the results search
            resultsContainer.show();
        }

        function generateLinkExport(code) {
            $('#exportFormat').change(function() {
                // Get the selected value
                let selectedFormat = $(this).val();
                console.log(selectedFormat)
                if (selectedFormat === 'pdf') {
                    // let exportUrl = `vehicles/checklist/export/${code}`;
                    // Update the href attribute of the link in the PDF option
                    $('#export_data').attr('data-code', code);
                }
            });
        }

        $('#export_data').on('click', function () {
                    let data = $(this).data();
                    let code = data.code;

                    // Create a hidden link
                    let downloadLink = document.createElement('a');
                    document.body.appendChild(downloadLink);

                    $.ajax({
                        method: 'get',
                        url: `{{ url('vehicles/checklist/export') }}/${code}`,
                        xhrFields: {
                            responseType: 'blob' 
                        },
                        success: function (response) {
                            // let blob = new Blob([response], { type: 'application/pdf' });
                            // let url = window.URL.createObjectURL(blob);
                            // downloadLink.href = url;
                            // downloadLink.download = `vehicle_${code}.pdf`;
                            // downloadLink.click();
                            // document.body.removeChild(downloadLink);
                            // console.log('PDF opened');

                            let blob = new Blob([response], { type: 'application/pdf' });
                            let url = window.URL.createObjectURL(blob);

                            // Open the PDF in a new tab or window
                            window.open(url, '_blank');

                            console.log('PDF opened');


                            // hide the modal
                            $('#kt_subscriptions_export_modal').modal('hide');
                        },
                        error: function (error) {
                            console.error('Error downloading PDF:', error);
                            $('#kt_subscriptions_export_modal').modal('hide');
                        }
                    });
        });



        function populateResultData(vehicle_name, vehicle_code, vehicle_number) {
            let template = `
			<div class="row m-8">
					<label class="col-lg-4 fw-bolder text-muted">Nama Kendaraan</label>
					<div class="col-lg-8">
						<span class="fw-bolder fs-6 text-gray-800">${vehicle_name}</span>
					</div>
			</div>
			<div class="row m-8">
				<label class="col-lg-4 fw-bolder text-muted">ID Kendaraan</label>
				<div class="col-lg-8">
					<span class="fw-bolder fs-6 text-gray-800">${vehicle_code}</span>
				</div>
			</div>
			<div class="row m-8">
				<label class="col-lg-4 fw-bolder text-muted">Nomor Polisi
					<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Nomor Polisi Sudah Terdaftar di Database"></i></label>
				<div class="col-lg-8 d-flex align-items-center">
					<span class="fw-bolder fs-6 text-gray-800 me-2">${vehicle_number}</span>
					<span class="badge badge-success">Registry</span>
				</div>
			</div>
			`;

            resultPopulate.html(template)
        }

        // Hide results container on clicks outside input and container
        $(document).on('click', function(event) {
            if (!searchInput.is(event.target) && !resultsContainer.is(event.target) && resultsContainer.has(event.target).length === 0) {
                resultsContainer.hide();
            }
        });

        function convertDate(date) {
            return moment(date).format('DD MMMM YYYY')
        }
        // datatable 
        function checkListData(code) {

            setTimeout(function() {
                /*$.fn.dataTable.ext.errMode = () => errorFunction();*/

                $('table#checklist_datatable').DataTable({
                    processing: true
                    , serverSide: true
                    , searching: true
                    , destroy: true,
                    /*stateSave:true,*/
                    ajax: {
                        url: `{{ url('vehicles/checklist/') }}/${code}`
                        , error: function(jqXHR, textstatus, errorThrown) {
                            Swal.fire({
                                title: 'Kesalahan saat memuat data tabel. Harap segarkan?'
                                , text: errorThrown
                                , icon: 'warning'
                                , showCancelButton: false
                                , confirmButtonColor: '#3085d6'
                                , cancelButtonColor: '#d33'
                                , confirmButtonText: 'Ya, segarkan!'
                            , }).then((question) => {
                                if (question.isConfirmed) {
                                    $('button#refresh').click();
                                }
                            })
                        }
                    }
                    , searchDelay: 1000
                    , scrollX: !0
                    , pagingType: "full_numbers"
                    , lengthMenu: [
                        [5, 10, 25, 50, 100, -1]
                        , [5, 10, 25, 50, 100, 'semua']
                    ]
                    , pageLength: 5
                    , language: {
                        paginate: {
                            first: '«'
                            , previous: '‹'
                            , next: '›'
                            , last: '»'
                        }
                        , aria: {
                            paginate: {
                                first: 'Awal'
                                , previous: 'Selanjutnya'
                                , next: 'Berikutnya'
                                , last: 'Berikutnya'
                            }
                        }
                        , sInfo: '_MAX_ total baris data'
                        , sInfoFiltered: 'Terfilter dari _MAX_ total baris data'
                        , sInfoEmpty: 'Tampil 0 dari 0'
                        , sEmptyTable: `Tidak ada baris data...`
                        , sZeroRecords: 'Tidak ada baris data yang cocok...'
                        , sLengthMenu: 'Tampil _MENU_ Baris'
                        , search: 'Pencarian'
                    , }
                    , dom: "<'row'" +
                        "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                        "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                        ">" +

                        "<'table-responsive'tr>" +

                        "<'row'" +
                        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                        ">"
                    , columns: [{
                                data: 'DT_RowIndex'
                                , name: 'DT_RowIndex'
                                , orderable: false
                                , searchable: false
                            }
                            , {
                                data: 'forms.form_name'
                                , name: 'forms.form_name'
                            }
                            , {
                                data: 'vehicle_code'
                                , name: 'vehicle_code'
                            }
                            , {
                                data: 'form_id'
                                , name: 'form_id'
                            }
                            , {
                                data: 'status'
                                , name: 'status'
                            }
                            , {
                                data: null
                                , orderable: false
                                , searchable: false
                            }
                        ]

                    , createdRow: function(row, data, dataIndex, cells) {

                        function renderStatusTemplate(text) {
                            return `
                            <div class="badge bg-${text.toLowerCase() === 'baik' ? 'success':'warning'} text-wrap fs-6">${text}</div>
                            `
                        }

                        function checkData(id, form_id, vehicle_code) {
                           
                            if (data['is_good'] !== null) {
                                return `${data['is_good'] === 1 ? renderStatusTemplate('Baik') : renderStatusTemplate('Tidak Baik')}`;
                            } else if (initialData[dataIndex]?.is_update) {
                                return `
                                    ${initialData[dataIndex]?.is_good === 1 ? renderStatusTemplate('Baik') : renderStatusTemplate('Tidak Baik')}
                                `;
                            } else {

                                return actionButton(id, form_id, vehicle_code);
                            }
                        }

                        let actionButton = (id, form_id, vehicle_code) => `
                        <a id="button-dropdown" href="#" class="btn btn-light btn-active-light-primary btn-sm btn-dropdown-status" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                Status
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                </svg>
                            </span>
                          
                        </a>
                        <div id="menu-sub-dropdown" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a  type="button"  id="btn_baik" data-index="${dataIndex}" data-form="${data[form_id]}" data-code="${data[vehicle_code]}" data-id="${data[id]}" data-status="1" class="menu-link px-3 btn-status">Baik</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a type="button"  id="btn_buruk" data-index="${dataIndex}" data-form="${data[form_id]}" data-code="${data[vehicle_code]}" data-id="${data[id]}" data-status="0" class="menu-link px-3 btn-status">Tidak Baik</a>
                                </div>
                        </div>
                        
                        `
                        $(cells[0]).html('<div class="badge bg-dark text-wrap fs-6">' + data['DT_RowIndex'] + '</div>')
                        $(cells[1]).html(data['forms']['form_name'])
                        $(cells[2]).html('-')
                        $(cells[3]).html(data['updated_at'] ? convertDate(data['updated_at']) : '-')
                        $(cells[4]).html(data['status'])
                        $(cells[5]).html(initialData ? checkData('checklist_id', 'form_id', 'vehicle_code') : actionButton('checklist_id', 'form_id', 'vehicle_code'))
                    }
                    , drawCallback: function() {
                        $(".dataTables_paginate > .pagination").addClass("pagination-rounded")


                        $(document).on('click', function(e) {
                            const buttonDropdown = $('.btn-dropdown-status');
                            const dropdownContent = buttonDropdown.next();

                            // Check if the click is outside the button and its dropdown content
                            if (!buttonDropdown.is(e.target) && !dropdownContent.is(e.target) && dropdownContent.has(e.target).length === 0) {
                                // Hide the dropdown content
                                dropdownContent.slideUp('down');
                            }
                        });
                        $('.btn-dropdown-status').click(function(e) {
                            e.preventDefault();
                            $(this).next().slideToggle('down')
                        })

                    }
                , });

            }, 500)

        }

        $('button#refresh').on('click', function() {
            if ($('table#checklist_datatable').DataTable().settings()[0]['oInit'].serverSide == true) {
                $('table#checklist_datatable').DataTable().draw();
            } else {
                window.location.reload();
            }
        });



        setTimeout(function() {

            $('button#btn_add').on('click', function() {
                let data = $(this).data()
                let id = data.id
                $.ajax({
                    method: 'get'
                    , url: `{{ route('checklist.create') }}`
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , success: function(res) {
                        $('div#modal_default').find('.modal-content').html(res);
                    }
                });
            });


            // for update state
            $('table#checklist_datatable').on('click', 'a.btn-status', function() {
                let data = $(this).data()
                let id = data.id
                let status = parseInt(data.status);
                let vehicle_code = data.code;
                let form_id = data.form;
                let data_index = data.index;
                Swal.fire({
                    title: 'Keterangan'
                    , input: 'textarea'
                    , allowOutsideClick: false
                    , allowEscapeKey: false
                , }).then(function(result) {
                    if (result.value == "") {
                        Swal.fire({
                            title: 'Opps'
                            , text: 'Tidak boleh kosong'
                            , icon: 'error'
                            , showConfirmButton: false
                            , timer: 2000
                            , timerProgressBar: true
                            , didOpen: () => {}
                            , willClose: () => {}
                        })
                    } else {
                        Swal.fire({
                            title: 'Apa kamu yakin?'
                            , text: "data akan dikirim!"
                            , icon: 'warning'
                            , showCancelButton: true
                            , confirmButtonColor: '#3085d6'
                            , cancelButtonColor: '#d33'
                            , confirmButtonText: 'Ya, kirim!'
                            , cancelButtonText: 'Batal'
                        }).then((question) => {
                            if (question.isConfirmed) {

                                initialData[data_index] = {
                                    data_index: data_index
                                    , checklist_id: id
                                    , status: result.value
                                    , is_good: status
                                    , vehicle_code: vehicle_code
                                    , form_id: form_id
                                    , is_update: true
                                };

                                Swal.fire({
                                    title: 'Berhasil'
                                    , text: 'Data disimpan ke penyimpanan sementara. Tekan submit progress untuk update data.'
                                    , icon: 'success'
                                    , showConfirmButton: false
                                    , timer: 2000
                                    , timerProgressBar: true
                                    , didOpen: () => {}
                                    , willClose: () => {
                                        $('button#refresh').click();
                                    }
                                });
                            }
                        });
                    }
                });
            });

            $('#submit_progress').on('click', function() {
                Swal.fire({
                    title: 'Apa kamu yakin?'
                    , text: "data akan dikirim!"
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#3085d6'
                    , cancelButtonColor: '#d33'
                    , confirmButtonText: 'Ya, kirim!'
                    , cancelButtonText: 'Batal'
                }).then((question) => {
                    if (question.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                            , method: 'POST'
                            , cache: false
                            , data: {
                                initialData
                            }
                            , url: `{{ url('vehicles/checklist/update/') }}`
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
                                        $('button#refresh').click();
                                    }
                                })
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

                    }
                });
            });
        }, 500)

    })

</script>

<script>


</script>


@endpush
