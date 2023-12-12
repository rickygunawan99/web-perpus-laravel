@extends('layouts/contentNavbarLayout')

@section('title', 'Konfirmasi Peminjaman')

@section('content')
    <form action="/confirm/{{$cart->id}}" method="post">
        @csrf
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Konfirmasi Peminjaman
                </h5>
                <hr>

                <h5>Identitas Peminjam : {{$cart->member->name}}</h5>

                <h5>Daftar buku dipinjam</h5>
                <ul class="list-group list-group-numbered">
                    @foreach($cart->books as $book)
                        <li class="list-group-item">{{$book->title}}</li>
                    @endforeach
                </ul>

                <div class="divider"></div>

                <h5>Durasi Peminjaman : {{$cart->total_day}} hari</h5>

                <div>
                    <button class="btn btn-success mt-3" type="submit">Konfirmasi</button>
                </div>
            </div>
        </div>
    </form>
@endsection
