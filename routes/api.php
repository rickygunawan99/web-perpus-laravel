<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('books', function (){
    $books = \App\Models\Book::all();

    return \Yajra\DataTables\DataTables::of($books)
        ->addColumn('id', function ($query){
            return $query->id_book;
        })
        ->addColumn('category', function ($query){
            return $query->category->category_name;
        })
        ->addColumn('publisher', function ($query){
            return $query->publisher->name;
        })
        ->make();
});

Route::get('members', function (){
    $member = \App\Models\Member::all();

    return \Yajra\DataTables\DataTables::of($member)
        ->addIndexColumn()
        ->addColumn('status', function ($row){
            return $row->deleted_at ? 'true' : 'false';
        })
        ->addColumn('tanggal_daftar', function ($row){
            return $row->created_at->toFormattedDateString();
        })
        ->make();
});

Route::get('carts', function (){
    $cart = \App\Models\Cart::where('is_checkout', 1)
        ->where('is_approve', 'pending')->get();

    return \Yajra\DataTables\DataTables::of($cart)
        ->addIndexColumn()
        ->addColumn('action', function ($row){
            return "<div class='py-2'><a class='btn btn-label-primary' href='/admin/confirm/$row->id' >Konfirmasi</div>";
        })
        ->make();
});

Route::get('/confirm-list', function (){
    $cart = \App\Models\Cart::where('is_approve', 'approve')->get();

    return \Yajra\DataTables\DataTables::of($cart)
        ->addIndexColumn()
        ->addColumn('email', function ($row){
            return $row->member->email;
        })
        ->addColumn('action', function ($row){
            return "<div class='py-2'><a class='btn btn-label-primary' href='/admin/return/$row->id' >Konfirmasi</div>";
        })
        ->make();
});
