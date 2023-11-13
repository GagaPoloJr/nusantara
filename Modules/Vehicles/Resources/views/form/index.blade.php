@extends('vehicles::layouts.master')

@section('container')
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">Registrasi Form Cek</span>
        </h3>
        <div class="card" data-bs-placement="top">
            @can('create access')
            <button type="button" class="btn btn-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal_default" id="btn_add">
                {{-- <i class="fa fa-plus"></i> --}}
                Tambah
            </button>
            @endcan
           
        </div>
        <div class="col-sm-12">
            <div class="text-sm-end mt-2 mt-sm-0">
                <button type="button" class="btn btn-secondary btn-sm float-end  rounded-pill" id="refresh"><i class="fa fa-refresh"></i> Segarkan</button>
            </div>
        </div><!-- end col-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table id="form_datatable" class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <!--begin::Table head-->
                <thead class="fs-7 text-gray-400 text-uppercase">
                    <tr class="fw-bolder text-muted">
                        <th>No.</th>
                        <th class="min-w-150px">Nama Form</th>
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

            var formDatatable = $('table#form_datatable').DataTable({
                processing: true
                , serverSide: true
                , searching: true,
                /*stateSave:true,*/
                ajax: {
                    url: `{{ route('form.datatable.all') }}`
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
                        data: 'form_name'
                        , name: 'form_name'
                    }
                    , {
                        data: null
                        , orderable: false
                        , searchable: false
                    }
                ]
                , createdRow: function(row, data, dataIndex, cells) {

                    $(cells[0]).html('<div class="badge bg-dark text-wrap fs-6">' + data['DT_RowIndex'] + '</div>')
                    $(cells[1]).html(data['form_name'])
                    $(cells[2]).html('<div class="btn-access  float-end"> @can("delete vehicles") <button id="btn_delete" data-id=' + data['form_id'] + ' type="button" class="btn btn-danger btn-sm waves-effect waves-light float-end me-1 p-2"><span class="btn-label"><i class="fa fa-trash p-1"></i></span>Hapus</button> @endcan @can("update vehicles") <button id="btn_update" data-id=' + data['form_id'] + ' type="button" class="btn btn-info btn-sm waves-effect waves-light float-end me-1 p-2" data-bs-toggle="modal" data-bs-target="#modal_default"><span class="btn-label"><i class="fa fa-pencil p-1"></i></span>Ubah</button> @endcan</div>')
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
                    , url: `{{ route('form.create') }}`
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , success: function(res) {
                        $('div#modal_default').find('.modal-content').html(res);
                    }
                , });
            });
            $('button#refresh').on('click', function() {
                if ($('table#form_datatable').DataTable().settings()[0]['oInit'].serverSide == true) {
                    $('table#form_datatable').DataTable().draw();
                } else {
                    window.location.reload();
                }
            });

            $('table#form_datatable').on('click', 'button#btn_update', function() {
                let data = $(this).data()
                let id = data.id
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , method: 'get'
                    , url: `{{ url('vehicles/form') }}/${id}/edit`
                    , success: function(res) {
                        $('div#modal_default').find('.modal-content').html(res);
                    }
                });
            });

            $('table#form_datatable').on('click', 'button#btn_delete', function() {
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
                                    , url: `{{ url('vehicles/form') }}/${id}`
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

        }, 500)

    })

</script>
@endpush
