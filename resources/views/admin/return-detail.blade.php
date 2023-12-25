@extends('layouts/contentNavbarLayout')

@section('title', 'Konfirmasi Peminjaman')

@section('content')
    <form action="/admin/return/{{$cart->id}}" method="post">
        @csrf
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Konfirmasi Pengembalian
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
                <h5>Terakhir pengembalian : {{$cart->created_at->addDays(2)->toFormattedDateString()}}</h5>

                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="biaya" placeholder="input biaya disini" aria-describedby="floatingInputHelp" />
                    <label for="floatingInput">Biaya</label>
                </div>

                <div class="form-floating mt-3">
                    <input type="text" class="form-control text-danger" value="0" id="floatingInput2" name="denda" placeholder="input denda disini" aria-describedby="floatingInputHelp" />
                    <label for="floatingInput2" class="text-danger">Denda</label>
                </div>

                <div>
                    <button class="btn btn-success mt-3" type="submit">Konfirmasi</button>
                </div>
            </div>
        </div>
    </form>
@endsection
