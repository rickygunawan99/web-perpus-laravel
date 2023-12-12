@extends('layouts/horizontalLayout')

@section('title', 'Riwayat Peminjaman')

@section('page-script')
    <script src="{{asset('assets/js/cards-actions.js')}}"></script>
@endsection

@section('content')
    <div class="d-flex flex-column gap-2 justify-content-center align-items-center">
        @foreach($histories as $history)
            <div class="card card-action w-75">
                <div class="card-header">
                    <div class="card-action-title">
                        <div class="d-flex justify-content-between">
                            <h6>ID Peminjaman : {{$history->id}}</h6>
                            <h6 @class([
                        $history->is_approve == "decline" => 'text-danger',
                        $history->is_approve == "pending" => 'text-warning',
                        $history->is_approve == "returned" => 'text-primary',
                        $history->is_approve == "approve" => 'text-success',
                        ])>{{ucfirst($history->is_approve)}}</h6>
                        </div>
                        <h6>Lama Peminjaman : {{$history->total_day}} hari</h6>

                    </div>
                    <div class="card-action-element">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons ti ti-chevron-right scaleX-n1-rtl ti-sm"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="collapse">
                    <div class="card-body pt-0">
                        <h6>Daftar Buku</h6>
                        <ul class="list-group list-group-numbered">
                            @foreach($history->books as $book)
                                <li class="list-group-item">{{$book->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection
