<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Member;
use App\Models\Publisher;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.dashboard');
    }

    public function books(Request $request): View
    {
        return view('admin.all-books', [
            'books' => Book::with('author')->with('publisher')->with('category')->cursorPaginate(10)
        ]);
    }

    public function addBook(): View
    {
        $categories = Category::all();
        return view('admin.tambah-buku', [
            'categories' => $categories
        ]);
    }

    public function doAddBook(StoreBookRequest $request): RedirectResponse
    {
        $validated = $request->safe()->all();

        $book = new Book();
        $book->title = $validated['judul-buku'];
        $book->total_page = $validated['jml-halaman'];

        $category = Category::where("id_category", $validated['kategori'])->first();

        $publisher = Publisher::where("name", $validated['nama-penerbit'])->firstOrCreate([
            'name' => $validated['nama-penerbit']
        ]);

        $book->category()->associate($category);
        $book->publisher()->associate($publisher);
        $book->save();

        foreach ($validated['nama-penulis'] as $index=>$author){
            $authors = Author::where("name", $author)->firstOrCreate([
                'name' => $author
            ]);
            $book->author()->syncWithoutDetaching($authors);
        }

        return redirect()->to('/admin')->with('success', 'Sukses menambahkan buku');
    }

    public function destroyBook(Request $request): RedirectResponse
    {
        try {
            $book = Book::find($request->input("hapus-buku-id"));
            $book->delete();

            return redirect()->to('/admin')->with('success', 'Sukses hapus buku');
        }catch (Exception $exception){
            return redirect()->to('/admin')->with('failed', $exception->getMessage());
        }
    }

    public function updateBook($id): View
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('admin.edit-buku', [
            'book' => $book,
            'categories' => $categories
        ]);
    }

    public function doUpdateBook(StoreBookRequest $request, $id): RedirectResponse
    {
        try {
            $validated = $request->all();
            $publisher = Publisher::where("name", $validated['nama-penerbit'])->firstOrCreate([
                'name' => $validated['nama-penerbit']
            ]);

            $book = Book::findOrFail($id);
            $book->title = $validated['judul-buku'];
            $book->total_page = $validated['jml-halaman'];
            $book->category()->associate(Category::where('id_category', $validated['kategori'])->first());

            $book->publisher()->associate($publisher);
            $book->push();

            return redirect()->action([AdminController::class, 'updateBook'], ['id'=>$id])->with('success', 'update buku berhasil');
        }catch (Exception $exception){
            return redirect()->action([AdminController::class, 'updateBook'], ['id'=>$id])->with('failed', $exception->getMessage());
        }
    }

    public function approve(Request $request): View
    {
        return view('admin.approve', [
            'transaction' => Cart::where('is_approve', 1)
                ->where('is_checkout', 1)->get()
        ]);
    }

    public function confirm(Cart $cart): View
    {
        return view('admin.confirm', [
           'cart' => $cart
        ]);
    }

    public function doConfirm(Request $request, Cart $cart): RedirectResponse
    {
        try {
            $cart->is_approve = $request->input('status');
            $cart->push();
        }catch (Exception $exception){

        }

        return redirect('/admin');
    }

    public function login(): View
    {
        return \view('admin.login');
    }

    public function doLogin(Request $request): RedirectResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'nip' => 'required|exists:admins,nip',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return redirect('/admin/login')->withErrors($validator);
            }
            $validated = $validator->safe()->all();
            $admin = Admin::where('nip', $validated['nip'])->first();

            if(!$admin || $validated['password'] != $admin->password){
                return redirect('/admin/login')->with('err', 'nip and password not found');
            }

            session(['role'=>'admin', 'id'=>$admin->id_admin]);

        }catch (Exception $exception){

        }
        return redirect('/admin');
    }

    public function waitingCarts(): View
    {
        return view('admin.approve-return', [
            'cart' => Cart::where('is_approve', 2)->get()
        ]);
    }

    public function cartDetail(Cart $cart): View
    {
        return view('admin.cart-return-detail', [
            'cart' => $cart
        ]);
    }

    public function chart(): View
    {
        return view('admin.chart');
    }

    public function doLogout(): RedirectResponse
    {
        session()->flush();
        return redirect('/');
    }
}
