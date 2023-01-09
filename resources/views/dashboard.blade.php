<!DOCTYPE html>
<html lang="en">

<head>
    @include('/partials/style')
    <title>Katalog Buku</title>
</head>

<body>
@include('/partials/navbar')

<div class="margin-t1"></div>

<div class="container">

    <section class="corousel">
        <div class="corousel-body js-flickity" data-flickity-options='{ "wrapAround": true }'>
            <div class="corousel-cell">
                <img src="https://source.unsplash.com/random/230x200/?library" alt="">
            </div>
            <div class="corousel-cell">
                <img src="https://source.unsplash.com/random/230x200/?store" alt="">
            </div>
            <div class="corousel-cell">
                <img src="https://source.unsplash.com/random/230x200/?garden" alt="">
            </div>
            <div class="corousel-cell">
                <img src="https://source.unsplash.com/random/230x200/?school" alt="">
            </div>
        </div>
    </section>

    <section class="container margin-t2">
        <div class="card">
            <h2>Kategori</h2>
            <section class="margin-t1">
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col card margin-r1 bg-primary bg-opacity-10 border border-2 border-primary rounded-end">
                            {{$category->category_name}}
                        </div>
                    @endforeach

                </div>
            </section>
            <div class="margin-t1">
            </div>
        </div>
    </section>

    <section class="container margin-t2">
        <div class="margin-l2 margin-r2">

            <h2>Rekomendasi Buku</h2>
            <div class="horizontal-scroll-body">
                <div class="container horizontal-scroll-wrapper">
                    <div class="d-flex">
                        @foreach($books as $book)
                            @include('book-card')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container margin-t2">
        <div class="margin-l2 margin-r2">
            <h2>Buku Lainnya</h2>
            <div class="horizontal-scroll-body">
                <div class="container horizontal-scroll-wrapper">
                    <div class="d-flex">
                        @foreach($book_recomendation as $book)
                            @include('book-card')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

@include('partials/footer')
</body>
@include('partials/script')

</html>
