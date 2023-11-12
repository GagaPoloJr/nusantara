<div class="modal-header">
    <h5 class="modal-title" id="scrollableModalTitle">Pengaturan Grup user {{ $user->user_name }}</h5>
    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
</div>
<div class="modal-body">
    <input type="hidden" id="user_id" value="{{ $user->user_id }}">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <!-- Portlet card -->
                        <div class="card card-custom card-stretch shadow">
                            <div class="card-body">
                                <h4 class="header-title mb-2">Tambah Grup User</h4>
                                <table id="notmember_datatable" class="table table-row-bordered table-row-dashed gy-4 align-middle">
                                    <thead class="fs-7 text-gray-400 text-uppercase">
                                    <tr>
                                        <th class="min-w-90px">Nama Grup</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Sedang memuat data...</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <!-- Portlet card -->
                        <div class="card card-custom card-stretch shadow">
                            <div class="card-body">
                                <h4 class="header-title mb-2">Daftar Grup User</h4>

                                <table id="member_datatable" class="table table-row-bordered table-row-dashed gy-4 align-middle">
                                    <thead class="fs-7 text-gray-400 text-uppercase">
                                    <tr>
                                        <th class="min-w-90px">Nama Grup</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Sedang memuat data...</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

<script>
    $(document).ready(function () {
        let user_id = $("input#user_id").val();

        $('table#notmember_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `{{ url('user/datatable') }}/{{ $user->user_id }}/group/notmember`,
            searchDelay: 1000,
            scrollCollapse: true,
            pagingType: "full_numbers",
            lengthMenu: [[5,10,25,50,100,-1],[5,10,25,50,100,'semua']],
            pageLength: 5,
            language:{
                paginate:{
                    previous:"<i class='previous'>",
                    next:"<i class='next'>"
                },
                sInfo:'_MAX_ total baris data',
                sInfoFiltered:'Terfilter dari _MAX_ total baris data',
                sInfoEmpty:'Tampil 0 dari 0',
                sEmptyTable:`Tidak ada baris data...`,
                sZeroRecords:'Tidak ada baris data yang cocok...',
                sLengthMenu:'Tampil _MENU_ Baris',
                search:'Pencarian',
            },
            dom:"<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",
            columns: [
                {data: 'name', name: 'name'},
                {data: null, orderable:false, searchable:false}
            ],
            createdRow: function(row, data, dataIndex,cells) {
                $(cells[0]).html(data['name'])
                $(cells[1]).html('@can("create user") <button type="button" class="btn btn-icon btn-light-twitter me-5 float-end" id="btn_join" data-id='+data['group_id']+'><i class="fa fa-person-walking-arrow-right"></i></button> @endcan');
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
        });
        $('table#notmember_datatable').on('click','button#btn_join',function () {
            let data = $(this).data()
            let id = data.id
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "data akan tersimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{{ route('user.group.store') }}",
                        type: "POST",
                        data: {user_id:user_id,group_id:id},
                        success:function(response){
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
                                    $('table#notmember_datatable').DataTable().draw();
                                    $('table#member_datatable').DataTable().draw();
                                    $("div#modal_default").modal('hide');
                                    $('button#refresh').click();
                                }
                            })
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: errors['message'],
                            });
                        }
                    });
                }
            });
        });
        $('table#member_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `{{ url('user/datatable') }}/{{ $user->user_id }}/group/member`,
            searchDelay: 1000,
            scrollCollapse: true,
            pagingType: "full_numbers",
            lengthMenu: [[5,10,25,50,100,-1],[5,10,25,50,100,'semua']],
            pageLength: 5,
            language:{
                paginate:{
                    previous:"<i class='previous'>",
                    next:"<i class='next'>"
                },
                sInfo:'_MAX_ total baris data',
                sInfoFiltered:'Terfilter dari _MAX_ total baris data',
                sInfoEmpty:'Tampil 0 dari 0',
                sEmptyTable:`Tidak ada baris data...`,
                sZeroRecords:'Tidak ada baris data yang cocok...',
                sLengthMenu:'Tampil _MENU_ Baris',
                search:'Pencarian',
            },
            dom:"<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",
            columns: [
                {data: 'name', name: 'name'},
                {data: null, orderable:false, searchable:false}
            ],
            createdRow: function(row, data, dataIndex,cells) {
                $(cells[0]).html(data['name'])
                $(cells[1]).html('@can("create user") <button type="button" class="btn btn-icon btn-light-youtube float-end" id="btn_leave" data-id='+data['group_id']+'><i class="fa fa-person-walking-arrow-right"></i></button> @endcan');
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
        });
        $('table#member_datatable').on('click','button#btn_leave',function () {
            let data = $(this).data()
            let id = data.id
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "data akan tersimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{{ route('user.group.destroy') }}",
                        type: "POST",
                        data: {user_id:user_id,group_id:id},
                        success:function(response){
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
                                    $('table#notmember_datatable').DataTable().draw();
                                    $('table#member_datatable').DataTable().draw();
                                    $("div#modal_default").modal('hide');
                                    $('button#refresh').click();
                                }
                            })
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: errors['message'],
                            });
                        }
                    });
                }
            });
        });
    });
</script>
