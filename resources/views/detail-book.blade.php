<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials/style')
    @include('partials/script')
    <title>Detail Buku</title>
</head>

<body>
@include('partials/navbar')

<div class="container-detail">
    <div class="book-picture">
        <img src="https://source.unsplash.com/random/230x200/?book" alt="buku">
        <!-- <a href="#" class="prev">&#10094;</a>
        <a href="#" class="next">&#10095;</a> -->
    </div>

    <input type="hidden" value="{{$book->id_book}}" id="id-book">
    <div class="book-detail">
        <div class="book-auth-name text-gray">
            @foreach($book->author as $author)
                {{$author->name}},
            @endforeach
        </div>
        <div class="book-title">
            <div class="text">{{$book->title}}</div>
        </div>
        <div style="font-weight: bold;">
            <div class="text">Description </div>
        </div>
        <div class="book-desc">
            <div class="text">
                {{$book->description}}
            </div>
        </div>
        <div class="detail-info">
            <div class="text bold">Detail Buku</div>
            <table style="width: 100%;">
                <tr>
                    <th style="width: 50%"></th>
                    <th></th>
                </tr>
{{--                <tr class="text-gray bold">--}}
{{--                    <td>Judul</td>--}}
{{--                </tr>--}}
{{--                <tr class="detail-value">--}}
{{--                    <td>{{$book->title}}</td>--}}
{{--                </tr>--}}
                <tr class="text-gray bold">
                    <td>Jumlah Halaman</td>
                </tr>
                <tr class="detail-value">
                    <td>{{$book->total_page}}</td>
                </tr>
            </table>
        </div>
        <div class="button">
            <button class="btn-cart" id="btn-cart">
                    <span class="cart-icon">
                        <i class="bi bi-bag"></i>
                    </span>
                Masukan ke Daftar Pinjam
            </button>
        </div>
        <input type="hidden" value="{{csrf_token()}}" id="token" name="_token">
    </div>
</div>

<script>

    const saveToCart = document.getElementById('btn-cart');
    console.info(saveToCart)

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
                _token: document.getElementById('token').value
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
                    window.location.href = '/login';
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

</body>
@include('partials/footer')
</html>
