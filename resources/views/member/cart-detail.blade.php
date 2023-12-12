@extends('layouts/horizontalLayout')

@section('title', 'Checkout')

@section('content')
    <section class="h-100 h-custom">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body fs-5">
                            <h5>Daftar Keranjang</h5>
                            <div class="table table-responsive">
                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($cart->books)
                                        @foreach($cart->books as $book)
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://source.unsplash.com/random/230x200/?book"
                                                             class="img-fluid rounded-3" alt="Book">
                                                        <div class="flex-column ms-4">
                                                            <p class="mb-2">{{$book->title}}</p>
                                                            <p class="mb-0 text-secondary">
                                                                @foreach($book->author as $author)
                                                                    {{$author->name}},
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="align-middle">
                                                    <p class="mb-0">{{$book->category->category_name}}</p>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-row">
                                                        <form action="{{route('cart.delete', ['id'=>$book->id_book])}}"
                                                              method="post">
                                                            @csrf
                                                            <button class="btn btn-danger px-2" type="submit">
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <form action="{{route('cart.checkout')}}" method="post" id="checkout">
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Peminjaman (Hari)</span>
                                            <input type="number" class="form-control" min="1" max="5" value="1" required
                                                   name="total-borrow" id="borrow">
                                        </div>
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-block btn-lg" id="checkout">
                                            <div class="d-flex justify-content-between">
                                                <span>Simpan</span>
                                            </div>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex mt-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
