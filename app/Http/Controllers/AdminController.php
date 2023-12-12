<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
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
        $book = Book::with('author')->with('publisher')->with('category')->cursorPaginate(10);
        if($request->input('s') !== null){
            $book = Book::with('author')
                ->with('publisher')
                ->with('category')
                ->where('title', 'like', "%{$request->input('s')}%")
                ->cursorPaginate(10);
        }
        return view('admin.all-books', [
            'books' => $book
        ]);
    }

    public function addBook(): View
    {
        $categories = Category::all();


        return view('admin.add-book', [
            'categories' => $categories
        ]);
    }

    public function doAddBook(StoreBookRequest $request): RedirectResponse
    {
        $validated = $request->safe()->all();

        $book = new Book();
        $book->title = $validated['judul-buku'];
        $book->total_page = $validated['jml-halaman'];

        $image = $request->file('image-upload');
        $book->description = $request->input('deskripsi');

//        $image->storePubliclyAs('img', $image->getClientOriginalName(), 'public');
//        $book->path_img = $image->getClientOriginalName();

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

        return redirect()->to('/admin/books')->with([
            'status' => 'success',
            'message' => 'Sukses tambah buku'
        ]);
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

    public function confirmCart(Request $request): View
    {
        return view('admin.confirm-all', [
            'transaction' => Cart::where('is_approve', 1)
                ->where('is_checkout', 1)->get()
        ]);
    }

    public function confirm(Cart $cart): View
    {
        return view('admin.confirm-detail', [
           'cart' => $cart
        ]);
    }

    public function doConfirm(Request $request, Cart $cart): RedirectResponse|JsonResponse
    {
        try {
            $cart->is_approve = $request->input('status');
            $cart->push();

            return redirect('/admin/confirm')->with([
                'status' => 'success',
                'message' => 'Berhasil konfirmasi peminjaman dengan nomor ' . $cart->id
            ]);
        }catch (Exception $exception){
            return response()->json([
                'status' =>  $exception->getCode(),
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function login(): View
    {
        return \view('admin.login');
    }

    public function doLogin(Request $request): RedirectResponse|JsonResponse
    {
        try {
            $credentials = $request->validate([
                'nip' => 'required|exists:admins,nip',
                'password' => 'required'
            ]);

            if(Auth::guard('admin')->attempt($credentials)){

                request()->session()->regenerate();

                $admin = Admin::where('nip', $credentials['nip'])->first();

                Auth::guard('admin')->login($admin);

                session(['role'=>'admin', 'id'=>$admin->id]);

                return redirect('/admin');
            }

            return redirect('/admin/login')->withErrors([
                'nip' => 'NIP dan password tidak ditemukan'
            ])->onlyInput('nip');

        }catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 501);
        }
    }

    public function confirmList(): View
    {
        return view('admin.return-list');
    }

    public function cartDetail(Cart $cart): View
    {
        return view('admin.return-detail', [
            'cart' => $cart
        ]);
    }

    public function cartDetailStore(Request $request, Cart $cart)
    {
        $cart->biaya = $request->input('biaya');
        $cart->denda = $request->input('denda') ?? 0;
        $cart->is_approve = 'returned';
        $cart->save();
        return redirect()->to('/admin/return')->with([
            'status' => 'success',
            'message' => 'Pengembalian dengan nomor ' . $cart->id . ' telah dikonfirmasi'
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

    public function addMember()
    {
        return \view('admin.tambah-member');
    }

    public function doAddMember(RegisterRequest $request)
    {
        $validated = $request->validated();

        Member::create($validated);

        return redirect()->route('admin.add-member')
            ->with(['success' => 'akun berhasil dibuat']);
    }

    public function member()
    {
        return view('admin.all-member');
    }
}
