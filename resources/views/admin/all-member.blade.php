@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Member')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection

@section('page-script')
    <script>
        $('.books-datatable').dataTable({
            ajax: '/api/members',
            serverSide: true,
            processing: true,
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'email'},
                {data: 'tanggal_daftar'},
                {data: 'status'}
            ],
            columnDefs: [
                {
                    target: 4,
                    render: function (data, type, full, meta){
                        if(data)
                            return '<span class="badge bg-success ">Aktif</span>'
                        else
                        return '<span class="ti ti-x bg-danger">Tidak aktif</span> '
                    }
                }
            ]
        })
    </script>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-5">
            <li class="breadcrumb-item">
                <a href="{{route('admin.all-member')}}">Member</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">List</a>
            </li>
        </ol>
    </nav>


    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="books-datatable table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Status</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
