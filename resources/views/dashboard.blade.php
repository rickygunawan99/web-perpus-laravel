@extends('layouts.horizontalLayout')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}"/>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/ui-carousel.css')}}"/>
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/ui-carousel.js')}}"></script>
@endsection

@section('content')
    <section id="search">
        <form action="" method="get">
            <div class="d-flex gap-3 align-items-center">
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                    <input type="text" class="form-control" placeholder="Cari buku .." autocomplete="off"
                           aria-describedby="basic-addon-search31" name="s" value="{{request('s') ?? ''}}" />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </section>
    <section id="gambar" class="mt-2">
        <div class="row">
            <div id="carouselExample-cf" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExample-cf" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExample-cf" data-bs-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" style="object-fit: cover; max-height: 300px" src="{{asset('assets/img/elements/books-cvr-1.jpg')}}" alt="Second slide" />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" style="object-fit: cover; max-height: 300px" src="{{asset('assets/img/elements/books-cvr-1.jpg')}}" alt="Third slide" />
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExample-cf" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample-cf" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </section>

    <section id="books-list" class="mt-3">
        <div class="row">
            @foreach($books as $book)
                <div class="col-12">
                    <div class="card mb-3 p-2">
                        <div class="row g-0 d-flex align-items-center">
                            <div class="col-3">
                                <img class="card-img card-img-left" height="200" style="object-fit: cover" src="{{asset('assets/img/elements/9.jpg')}}" alt="Card image" />
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title fs-5 fw-bold"> {{$book->title}} </h5>
                                    <span class="fs-6 text-black-50">Author : </span>
                                    @foreach($book->author as $author)
                                        @if($loop->index == count($book->author) -1 )
                                            <span class="fs-6 text-black-50">{{$author->name}}</span>
                                        @else
                                            <span class="fs-6 text-black-50">{{$author->name}}, </span>
                                        @endif
                                    @endforeach

                                    <p class="card-text mt-2">
                                        {{$book->description}}
                                    </p>

                                    <a href= "{{route('book.detail', ['id'=>$book->id_book])}}">
                                        Lihat detail
                                        <i class="ti ti-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row d-flex justify-content-end">
            {{$books->withQueryString()->links()}}
        </div>
    </section>
@endsection
