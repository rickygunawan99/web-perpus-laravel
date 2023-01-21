<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('admin.partials.style-part')

    <title>Admin</title>
    @if(Session::has('success'))
        <div class="alert alert-success w-50 mx-auto" role="alert">
            {{Session::get('success')}}
        </div>
    @endif

    @if(Session::has('failed'))
        <div class="alert alert-danger w-50 mx-auto" role="alert">
            {{Session::get('failed')}}
        </div>
    @endif
</head>

<body>
@include('admin.partials.navbar-part')
<section>
    <div class="container">
        <button class="btn btn-secondary mt-2" type="button" id="viewChart">View Chart</button>
        <div class="container d-flex mt-3">
            <div class="container h-50 my-auto" id="panel-input-month"></div>
            <div class="container" id="panel-chart"></div>
        </div>
    </div>

</section>

<div class="container mt-4">
    <section class="mt-4">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Kategori</th>
                {{--                        <th scope="col">Penulis</th>--}}
                <th scope="col">Penerbit</th>
                {{--                        <th scope="col">Stok</th>--}}
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$book->title}}</td>
                    <td>{{$book->category->category_name}}</td>
                    {{--                            <td>{{$book->author->name}}</td>--}}
                    <td>{{$book->publisher->name}}</td>
                    {{--                            <td>{{$book->stock ?? 'N/A'}}</td>--}}
                    <td>
                        <a href="{{route('book.update.store', ['id'=>$book->id_book])}}" class="btn btn-primary btn-sm"><i class="bi bi-pen"></i></a>
                        <button type="submit" class="btn btn-danger btn-sm open-modal-hapus-buku" data-bs-toggle="modal" data-bs-target="#hapusBukuModal"
                                data-id="{{$book->id_book}}"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</div>

<div class="d-flex justify-content-end me-5 pe-2">
    {{$books->links()}}
</div>

<!-- Modal -->
<div class="modal fade" id="hapusBukuModal" tabindex="-1" aria-labelledby="hapusBukuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusBukuModalLabel">Hapus Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Yakin Ingin Menghapus Buku ini ?
            </div>
            <div class="modal-footer">
                <form action="{{route('book.destroy')}}" method="post">
                    @csrf
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <input type="text" name="hapus-buku-id" id="hapus-buku-id" value="" hidden />
                    <button type="submit" name="hapus-submit" class="btn btn-primary">Ya</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>


@include('admin.partials.script-part')

<script>

    $(document).on("click", ".open-modal-hapus-buku", function() {
        const myBookId = $(this).data('id');
        $(".modal-footer #hapus-buku-id").val(myBookId);
        // As pointed out in comments,
        // it is unnecessary to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });

    document.getElementById('viewChart').onclick = () => {
        const year = document.createElement('input');
        year.type = 'number';
        year.min = '1900';
        year.placeholder = 'Input tahun';
        year.id = 'year-value';
        const submit = document.createElement('button');
        submit.type = 'button';
        submit.classList.add('btn');
        submit.classList.add('btn-primary');
        submit.classList.add('btn-sm');
        submit.classList.add('ms-2');
        submit.textContent = 'submit';
        submit.id = 'year-submit';
        document.getElementById('panel-input-month').appendChild(year);
        document.getElementById('panel-input-month').appendChild(submit);

        document.getElementById('year-submit').onclick = () => {
            while (document.getElementById('panel-chart').hasChildNodes()){
                document.getElementById('panel-chart').firstChild.remove();
            }
            viewChart(document.getElementById('year-value').value);
        }
    }

    async function chartData(year)
    {
        const response = await fetch('/api/chart/'+year, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });
        return response.json();
    }

    function viewChart(year)
    {
        let month = [], value = [];
        chartData(year)
        .then((data) => {
            for (const dat of data) {
                month.push(dat.month);
                value.push(dat.count_book);
                // console.info(dat.month);
            }
        })
        .then(function(){
            const canvas = document.createElement('canvas');
            canvas.id = 'myChart';

            new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: month,
                    datasets: [{
                        label: 'Peminjaman tahun ' + year,
                        data: value,
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            document.getElementById('panel-chart').appendChild(canvas);
            document.getElementById('viewChart').disabled =  true;
        }).catch(error => console.error(error))
    }


</script>


</html>
