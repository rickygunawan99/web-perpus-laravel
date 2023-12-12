@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Peminjaman')

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
            ajax: '/api/carts',
            serverSide: true,
            processing: true,
            columns: [
                {data: 'id'},
                {data: 'is_approve'},
                {data: 'action'}
            ],
            columnDefs: [
                {
                    targets: [0,1,2],
                    className: 'fs-5'
                },
                {
                    target: 0,
                    width: '20%'
                },
                {
                    target: 1,
                    render: function (data){
                        if(data === 'pending')
                            return '<span class="text-warning">Pending</span>'
                        else if (data === 'approve')
                            return '<span class="text-success">Dikonfirmasi</span>'
                        else if (data === 'decline')
                            return '<span class="text-danger">Ditolak</span>'
                        else
                            return '<span class="text-black-50">Dikembalikan</span>'
                    },
                }
            ]
        })
    </script>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-5">
            <li class="breadcrumb-item">
                <a href="{{route('admin.confirm')}}">Peminjaman</a>
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
                    <th>id Peminjaman</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
