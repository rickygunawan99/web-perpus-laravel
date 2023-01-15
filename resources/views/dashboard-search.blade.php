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
        <div class="margin-l2 margin-r2">
            <h2>Buku dengan judul yang sama</h2>
            <div class="horizontal-scroll-body">
                <div class="container horizontal-scroll-wrapper">
                    <div class="d-flex flex-wrap">
                        @foreach($books as $book)
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
