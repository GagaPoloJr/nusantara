@extends('vehicles::layouts.master')

@section('container')
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">Registrasi Kendaraan halo test</span>
            <span class="text-muted mt-1 fw-bold fs-7">{{ $total }} Kendaraan Sudah Teregistrasi</span>
        </h3>
        <div class="card" data-bs-placement="top">
            @can('create access')
            <button type="button" class="btn btn-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal_default" id="btn_add">
                {{-- <i class="fa fa-plus"></i> --}}
                Registrasi
            </button>
            @endcan
        </div>

    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table id="vehicle_datatable" class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <!--begin::Table head-->
                <thead class="fs-7 text-gray-400 text-uppercase">
                    <tr class="fw-bolder text-muted">
                        <th>No.</th>
                        <th class="min-w-150px">Nama Kendaraan</th>
                        <th class="min-w-150px">Nomor Polisi</th>
                        {{-- <th class="min-w-150px">Progress Pengecekan</th> --}}

                        <th class="min-w-100px text-end">Actions</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-semibold text-gray-600">
                    <tr>
                        <td>Sedang memuat data...</td>
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


@endsection


@push('js')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            /*$.fn.dataTable.ext.errMode = () => errorFunction();*/

            var vehicleDatatable = $('table#vehicle_datatable').DataTable({
                processing: true
                , serverSide: true
                , searching: true,
                /*stateSave:true,*/
                ajax: {
                    url: `{{ route('vehicles.datatable.all') }}`
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
                        data: 'vehicle_name'
                        , name: 'vehicle_name'
                    }
                    , {
                        data: 'vehicle_number'
                        , name: 'vehicle_number'
                    }
                    , {
                        data: null
                        , orderable: false
                        , searchable: false
                    }
                ]
                , createdRow: function(row, data, dataIndex, cells) {
                    let styledColumn = (value1, value2) => `
                    <div class="d-flex justify-content-start flex-column">
                      <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">${data[value1]}</a>
                        <span class="text-muted fw-bold text-muted d-block fs-7">${data[value2]}</span>
                    </div>
                    `
                    let styledColumn2 = (value1, value2) => `
                    <div class="d-flex justify-content-start flex-column">
                      <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">${data[value1]}</a>
                      <span class="text-muted fw-bold text-muted d-block fs-7">${data[value2]['name']}</span>
                       
                    </div>
                    `

                    $(cells[0]).html('<div class="badge bg-dark text-wrap fs-6">' + data['DT_RowIndex'] + '</div>')
                    $(cells[1]).html(styledColumn('vehicle_name', 'vehicle_code'))
                    $(cells[2]).html(styledColumn2('vehicle_number', 'vehicle_category'))
                    $(cells[3]).html('<div class="btn-access  float-end"> @can("delete access") <button id="btn_delete" data-id=' + data['vehicle_id'] + ' type="button" class="btn btn-danger btn-sm waves-effect waves-light float-end me-1 p-2"><span class="btn-label"><i class="fa fa-trash p-1"></i></span>Hapus</button> @endcan @can("update access") <button id="btn_update" data-id=' + data['vehicle_id'] + ' type="button" class="btn btn-info btn-sm waves-effect waves-light float-end me-1 p-2" data-bs-toggle="modal" data-bs-target="#modal_default"><span class="btn-label"><i class="fa fa-pencil p-1"></i></span>Ubah</button> @endcan</div>')
                }
                , drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            , });

            $('button#btn_add').on('click', function() {
                let data = $(this).data()
                let id = data.id
                $.ajax({
                    method: 'get',
                     url: `{{ route('vehicles.create') }}`, 
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                     success: function(res) {
                        $('div#modal_default').find('.modal-content').html(res);
                    },
                });
            });
        }, 500)

    })

</script>
@endpush



{{-- <div class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table id="vehicle_datatable" class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
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
</div> --}}
