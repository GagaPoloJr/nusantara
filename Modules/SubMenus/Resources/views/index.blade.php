@extends('submenus::layouts.master')

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
                    <div class="card-header">
                        <h2 class="card-title fw-bold">
                            Daftar Sub Menu
                        </h2>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                @can('create access')
                                <button type="button" class="btn btn-primary rounded-pill btn-sm" data-bs-toggle="modal" data-bs-target="#modal_default" id="btn_add">
                                    <i class="fa fa-plus"></i>
                                    Tambah
                                </button>
                                @endcan
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end mt-2 mt-sm-0">
                                    <button type="button" class="btn btn-primary btn-sm float-end me-4 rounded-pill" id="refresh"><i class="fa fa-refresh"></i> Segarkan</button>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <table class="table table-row-bordered table-row-dashed gy-4 align-middle" id="submenu_datatable">
                            <thead class="fs-7 text-gray-400 text-uppercase">
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA SUB MENU</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td>Sedang memuat data...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            /*$.fn.dataTable.ext.errMode = () => errorFunction();*/

            $('table#submenu_datatable').DataTable({
                processing: true
                , serverSide: true
                , searching: true,
                /*stateSave:true,*/
                ajax: {
                    url: `{{ route('submenu.datatable.all') }}`
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
                }, {
                    data: 'sub_menu_name'
                    , name: 'sub_menu_name'
                }, {
                    data: null
                    , orderable: false
                    , searchable: false
                }]
                , createdRow: function(row, data, dataIndex, cells) {
                    $(cells[0]).html('<div class="badge bg-dark text-wrap fs-6">' + data['DT_RowIndex'] + '</div>')
                    $(cells[1]).html(data['sub_menu_name'])
                    $(cells[2]).html('<div class="btn-access  float-end"> @can("delete access") <button id="btn_delete" data-id=' + data['sub_menu_id'] + ' type="button" class="btn btn-danger btn-sm waves-effect waves-light float-end me-1 p-2"><span class="btn-label"><i class="fa fa-trash p-1"></i></span>Hapus</button> @endcan @can("update access") <button id="btn_update" data-id=' + data['sub_menu_id'] + ' type="button" class="btn btn-info btn-sm waves-effect waves-light float-end me-1 p-2" data-bs-toggle="modal" data-bs-target="#modal_default"><span class="btn-label"><i class="fa fa-pencil p-1"></i></span>Ubah</button> @endcan</div>')
                }
                , drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            , });
            $('button#btn_add').on('click', function() {
                let data = $(this).data()
                let id = data.id
                $.ajax({
                    method: 'get'
                    , url: `{{ route('submenu.create') }}`
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , success: function(res) {
                        $('div#modal_default').find('.modal-content').html(res);
                    }
                });
            });
            $('button#refresh').on('click', function() {
                if ($('table#submenu_datatable').DataTable().settings()[0]['oInit'].serverSide == true) {
                    $('table#submenu_datatable').DataTable().draw();
                } else {
                    window.location.reload();
                }
            });
            $('table#submenu_datatable').on('click', 'button#btn_update', function() {
                let data = $(this).data()
                let id = data.id
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , method: 'get'
                    , url: `{{ url('access/') }}/${id}/edit`
                    , success: function(res) {
                        $('div#modal_default').find('.modal-content').html(res);
                    }
                });
            });
            $('table#submenu_datatable').on('click', 'button#btn_delete', function() {
                let data = $(this).data()
                let id = data.id

                Swal.fire({
                    title: 'Alasan'
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
                            , text: "data akan dihapus!"
                            , icon: 'warning'
                            , showCancelButton: true
                            , confirmButtonColor: '#3085d6'
                            , cancelButtonColor: '#d33'
                            , confirmButtonText: 'Ya, hapus!'
                            , cancelButtonText: 'Batal'
                        }).then((question) => {
                            if (question.isConfirmed) {
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                    , method: 'DELETE'
                                    , cache: false
                                    , data: {
                                        "reason": result.value
                                    }
                                    , url: `{{ url('access/') }}/${id}`
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
                    }
                });
            });
        }, 500);
    });

</script>
@endpush
