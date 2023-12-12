@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Buku')

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
            ajax: '/api/books',
            serverSide: true,
            processing: true,
            columns: [
                {data: 'id'},
                {data: 'title'},
                {data: 'description'},
                {data: 'category'},
                {data: 'publisher'}
            ]
        })
    </script>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-5">
            <li class="breadcrumb-item">
                <a href="{{route('admin.books')}}">Buku</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">List</a>
            </li>
        </ol>
    </nav>

    <div class="d-flex flex-column flex-md-row justify-content-between mb-3">
        <p class="fw-bold text-black fs-4">Buku</p>
        <a href="{{route('admin.add-book')}}" class="btn btn-primary align-self-baseline">Tambah buku</a>
    </div>

    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="books-datatable table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Publisher</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
