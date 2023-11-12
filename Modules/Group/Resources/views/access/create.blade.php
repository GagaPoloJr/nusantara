
<div class="modal-header">
    <h5 class="modal-title" id="scrollableModalTitle">Tambah Akses Grup {{ $group->name }}</h5>
    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
</div>
<div class="modal-body">
    <input type="hidden" id="group_id" value="{{ $group->group_id }}">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <!-- Portlet card -->
                        <div class="card card-custom card-stretch shadow">
                            <div class="card-body">
                                <h4 class="header-title mb-2">Tambah Akses Grup</h4>
                                <table id="nothave_datatable" class="table table-row-bordered table-row-dashed gy-4 align-middle">
                                    <thead class="fs-7 text-gray-400 text-uppercase">
                                    <tr>
                                        <th>No</th>
                                        <th class="min-w-90px">Nama Akses</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Sedang memuat data...</td>
                                    </tr>
                                    </tbody>
                                    <tfood>
                                        <tr>
                                            <td colspan="2"><button type="button" class="btn btn-success btn-sm float-end me-0" id="btn_give"><span class="btn-label"><i class="fa fa-key"></i></span>Izinkan</button></td>
                                        </tr>
                                    </tfood>
                                </table>
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <!-- Portlet card -->
                        <div class="card card-custom card-stretch shadow">
                            <div class="card-body">
                                <h4 class="header-title mb-2">Daftar Akses Yang Dimiliki</h4>

                                <table id="have_datatable" class="table table-row-bordered table-row-dashed gy-4 align-middle">
                                    <thead class="fs-7 text-gray-400 text-uppercase">
                                    <tr>
                                        <th>No</th>
                                        <th class="min-w-90px">Nama Akses</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Sedang memuat data...</td>
                                    </tr>
                                    </tbody>
                                    <tfood>
                                        <tr>
                                            <td colspan="2"><button type="button" class="btn btn-danger btn-sm float-end me-0" id="btn_revoke"><span class="btn-label"><i class="fa fa-lock"></i></span>Hapus izin</button></td>
                                        </tr>
                                    </tfood>
                                </table>
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
<!-- end row -->

</div>
<div class="modal-footer">
</div>

<script>
    $(document).ready(function() {
        $('table#have_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `{{ url('group/datatable') }}/{{ $group->group_id }}/access`,
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
                {data: 'DT_RowIndex', name:'DT_RowIndex' ,orderable:false, searchable:false},
                {data: 'name', name: 'name'},
                {data: 'DT_RowIndex', name:'DT_RowIndex' ,orderable:false, searchable:false},
            ],
            createdRow: function(row, data, dataIndex,cells) {
                $(cells[0]).html('<div class="badge bg-dark text-wrap fs-6">'+data['DT_RowIndex']+'</div>');
                $(cells[1]).html(data['name']);
                $(cells[2]).html('<div class="form-check form-check-custom form-check-solid"> <input type="checkbox" name="revoke_checkbox[]" class="form-check-input rounded-circle revoke_checkbox"  value='+data["access_id"]+' /> </div>');
            },
        });
        $('table#nothave_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `{{ url('group/datatable') }}/{{ $group->group_id }}/notaccess`,
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
                {data: 'DT_RowIndex', name:'DT_RowIndex' ,orderable:false, searchable:false},
                {data: 'name', name: 'name'},
                {data: 'DT_RowIndex', name:'DT_RowIndex' ,orderable:false, searchable:false},
            ],
            createdRow: function(row, data, dataIndex,cells) {
                $(cells[0]).html('<div class="badge bg-dark text-wrap fs-6">'+data['DT_RowIndex']+'</div>');
                $(cells[1]).html(data['name']);
                $(cells[2]).html('<div class="form-check form-check-custom form-check-solid"> <input type="checkbox" name="give_checkbox[]" class="form-check-input rounded-circle give_checkbox"  value='+data["access_id"]+' /> </div>');
            },
        });

        $('table#nothave_datatable').on('click', 'button#btn_give', function(){
            var id = [];

            $('.give_checkbox:checked').each(function(){
                id.push($(this).val());
            });
            if(id.length > 0) {
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
                            url:"{{ route('group.access.store') }}",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            method:"POST",
                            data:{access_id:id,group_id:`{{ $group->group_id }}`},
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
                                        $('table#nothave_datatable').DataTable().draw();
                                        $('table#have_datatable').DataTable().draw();
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
                    }
                });
            } else {
                Swal.fire({
                    icon: 'question',
                    title: 'Oops...',
                    text: 'Harap pilih setidaknya satu kotak centang!',
                    showConfirmButton: false,
                    timer: 2000,
                    showClass:{
                        popup: 'animate__animated animate__bounceIn'
                    },
                    hideClass:{
                        popup: 'animate__animated animate__fadeOut'
                    }
                });
            }
        });
        $('table#have_datatable').on('click', 'button#btn_revoke', function(){
            var id = [];

            $('.revoke_checkbox:checked').each(function(){
                id.push($(this).val());
            });
            if(id.length > 0) {
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
                            url:"{{ route('group.access.destroy') }}",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            method:"POST",
                            data:{access_id:id,group_id:`{{ $group->group_id }}`},
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
                                        $('table#nothave_datatable').DataTable().draw();
                                        $('table#have_datatable').DataTable().draw();
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
                    }
                })
            } else {
                Swal.fire({
                    icon: 'question',
                    title: 'Oops...',
                    text: 'Harap pilih setidaknya satu kotak centang!',
                    showConfirmButton: false,
                    timer: 2000,
                    showClass:{
                        popup: 'animate__animated animate__bounceIn'
                    },
                    hideClass:{
                        popup: 'animate__animated animate__fadeOut'
                    }
                });
            }
        });
    });
</script>
