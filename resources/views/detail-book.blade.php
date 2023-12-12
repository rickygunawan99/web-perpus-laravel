@extends('layouts.horizontalLayout')

@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        const saveToCart = document.getElementById('btn-cart');

        const idBook = document.getElementById('id-book').value;

        saveToCart.onclick = function(){
            const cartIcon = document.querySelector('ul li .btn-cart-nav');
            cart('save',idBook);
        }

        function cart(action, id_book){
            $.ajax({
                url: `/cart?action=${action}&book-id=${id_book}`,
                type: 'get',
                data: {
                    _token: "{{csrf_token()}}"
                },
                success: function (data){
                    if(data.status === 'oke'){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                        })
                    }else{
                        window.location.href = '/login'
                    }
                },
                error: function (data){
                    const response = JSON.parse(data.responseText)
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                    })
                }
            })

        }

    </script>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <img src="{{asset('assets/img/elements/9.jpg')}}" class="card-img card-img-left" alt="buku" style="object-fit: contain">
                </div>
                <div class="col-8">
                    <div class="d-flex gap-3 flex-column">
                        <h5 class="card-title fs-5 fw-bold"> {{$book->title}} </h5>
                        <div>
                            <span class="fs-6 text-black-50">Author : </span>
                            @foreach($book->author as $author)
                                @if($loop->index == count($book->author) -1 )
                                    <span class="fs-6 text-black-50">{{$author->name}}</span>
                                @else
                                    <span class="fs-6 text-black-50">{{$author->name}}, </span>
                                @endif
                            @endforeach
                        </div>
                        <h5 class="card-text">Jumlah Halaman : {{$book->total_page}}</h5>
                        <p class="card-text mt-2 fs-5">
                            Description : {{$book->description}}
                        </p>
                        <input type="hidden" value="{{$book->id_book}}" id="id-book">
                    </div>

                    <div class="d-flex align-items-end">
                        <button class="btn btn-primary" id="btn-cart">
                            Masukan ke Daftar Pinjam
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
