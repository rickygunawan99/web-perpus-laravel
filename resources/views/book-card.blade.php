<div class="col">
    <a href= "{{route('book.detail', ['id'=>$book->id_book])}}">
        <div class="card-box">
            <div class="card-img-container">
                <div class="card-inner-skew">
                    <img src="https://source.unsplash.com/random/230x200/?book" alt="-">
                </div>
            </div>
            <div class="card-text-container">
                <h3 class="card-title">{{$book->title}}</h3>
                <div class="card-inner-text-container">
                    {{$book->description}}
                </div>
            </div>
        </div>
    </a>
</div>
