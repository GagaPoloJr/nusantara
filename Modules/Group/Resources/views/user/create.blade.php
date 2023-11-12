
<div class="modal-header">
    <h5 class="modal-title" id="scrollableModalTitle">Tambah Anggota Grup {{ $group->name }}</h5>
    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-circle btn-light-youtube me-5" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close fs-4"></i></a>
</div>
<div class="modal-body">
   {{-- <div class="alert alert-primary d-flex align-items-center p-5">
        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
        <div class="d-flex flex-column">
            <h4 class="mb-1 text-dark">Perhatian</h4>
            <!--begin::Content-->
            <span>User yang tampil adalah user yang memiliki .</span>
        </div>
    </div>--}}
    <input type="hidden" id="group_id" value="{{ $group->group_id }}">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <!-- Portlet card -->
                        <div class="card card-custom card-stretch shadow">
                            <div class="card-body">
                                <h4 class="header-title mb-2">Tambah Anggota Grup</h4>
                                <table id="notmember_datatable" class="table table-row-bordered table-row-dashed gy-4 align-middle">
                                    <thead class="fs-7 text-gray-400 text-uppercase">
                                    <tr>
                                        <th class="min-w-90px">Nama</th>
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
                                            <td colspan="2"><button type="button" class="btn btn-success btn-sm float-end me-0" id="btn_join"><span class="btn-label"><i class="fa fa-user-plus"></i></span>Tambah</button></td>
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
                                <h4 class="header-title mb-2">Daftar Anggota Grup</h4>

                                <table id="member_datatable" class="table table-row-bordered table-row-dashed gy-4 align-middle">
                                    <thead class="fs-7 text-gray-400 text-uppercase">
                                    <tr>
                                        <th class="min-w-90px">Nama</th>
                                        <th class="min-w-20px">Admin Grup</th>
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
                                            <td colspan="2"><button type="button" class="btn btn-danger btn-sm float-end me-0" id="btn_leave"><span class="btn-label"><i class="fa fa-user-minus"></i></span>Hapus</button></td>
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

</div>
<div class="modal-footer">
</div>

<script>
    $(document).ready(function() {
        $('table#member_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `{{ url('group/datatable') }}/{{ $group->group_id }}/member`,
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
                {data: 'user_name', name: 'user_name'},
                {data: 'DT_RowIndex', name:'DT_RowIndex' ,orderable:false, searchable:false},
                {data: 'DT_RowIndex', name:'DT_RowIndex' ,orderable:false, searchable:false},
            ],
            createdRow: function(row, data, dataIndex,cells) {
                $(cells[0]).html(`<div class="d-flex align-items-center flex-grow-1">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-45px me-5">
                            <img src="{{ asset('') }}`+data['image']+`" alt="">
                        </div>
                        <!--end::Avatar-->

                        <!--begin::Info-->
                        <div class="d-flex flex-column">
                            <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">`+data['user_name']+`</a>
                        </div>
                        <!--end::Info-->
                    </div>`)
                if(data['is_admin']==true){
                    $(cells[1]).html(`<div class="form-check form-switch form-check-custom form-check-success">
                        <input class="form-check-input" type="checkbox" data-id=`+data['user_id']+` value="on" id="is_admin" checked="checked" />
                    </div>`)
                } else {
                    $(cells[1]).html(`<div class="form-check form-switch form-check-custom form-check-success">
                        <input class="form-check-input" type="checkbox" data-id=`+data['user_id']+` value="off" id="is_admin" />
                    </div>`)
                }
                $(cells[2]).html('<div class="form-check form-check-custom form-check-solid"> <input type="checkbox" name="leave_checkbox[]" class="form-check-input rounded-circle leave_checkbox"  value='+data["user_id"]+' /> </div>')

            },
        });

        $('table#member_datatable').on('click','#is_admin',function () {
            let value = $(this).val()
            let data = $(this).data()
            let id = data.id
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method:'POST',
                url:"{{ route('group.conf.isadmin') }}",
                data:{group_id:`{{$group->group_id}}`,id:id,value:value},
                success: function(response){
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
                                $('table#member_datatable').DataTable().draw();
                            } else {
                                $('table#member_datatable').DataTable().draw();
                            }

                        }
                    });
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

        });

        $('table#notmember_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `{{ url('group/datatable') }}/{{ $group->group_id }}/notmember`,
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
                {data: 'user_name', name: 'user_name'},
                {data: 'DT_RowIndex', name:'DT_RowIndex' ,orderable:false, searchable:false},
            ],
            createdRow: function(row, data, dataIndex,cells) {
                $(cells[0]).html(`<div class="d-flex align-items-center flex-grow-1">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-45px me-5">
                            <img src="{{ asset('') }}`+data['image']+`" alt="">
                        </div>
                        <!--end::Avatar-->

                        <!--begin::Info-->
                        <div class="d-flex flex-column">
                            <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">`+data['user_name']+`</a>
                        </div>
                        <!--end::Info-->
                    </div>`)
                $(cells[1]).html('<div class="form-check form-check-custom form-check-solid"> <input type="checkbox" name="join_checkbox[]" class="form-check-input rounded-circle join_checkbox"  value='+data["user_id"]+' /> </div>')
            },
        });
        $('table#notmember_datatable').on('click', 'button#btn_join', function(){
            var id = [];

            $('.join_checkbox:checked').each(function(){
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
                            url:"{{ route('group.user.store') }}",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            method:"POST",
                            data:{user_id:id,group_id:`{{ $group->group_id }}`},
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
                                        $('table#notmember_datatable').DataTable().draw();
                                        $('table#member_datatable').DataTable().draw();
                                    }
                                })
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: errors['message'],
                                })
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
                })
            }
        });
        $('table#member_datatable').on('click', 'button#btn_leave', function(){
            var id = [];

            $('.leave_checkbox:checked').each(function(){
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
                            url:"{{ route('group.user.destroy') }}",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            method:"POST",
                            data:{user_id:id,group_id:`{{ $group->group_id }}`},
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
                                        $('table#notmember_datatable').DataTable().draw();
                                        $('table#member_datatable').DataTable().draw();
                                    }
                                })
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: errors['message'],
                                })
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
                })
            }
        });
    });
</script>
