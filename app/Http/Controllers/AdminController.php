<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Book;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'books' => Book::with('author')->get()
        ]);
    }

    public function addBook(): View
    {
        $categories = Category::all();
        return view('admin.tambah-buku', [
            'categories' => $categories
        ]);
    }

    public function doAddBook(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'judul-buku' => ['required', 'max:200'],
            'jml-halaman' => ['required', 'gt:10'],
            'kategori' => 'required',
            'nama-penulis-1' => 'required',
            'nama-penerbit' => 'required'
        ], [
            'judul-buku.required' => 'required judul buku',
            'jml-halaman.gt' => 'minimal halaman 10'
        ]);

        if($validator->fails()){
            return response()->redirectToRoute('admin.add-book')
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->safe()->all();

        $book = new Book();
        $book->title = $validated['judul-buku'];
        $book->total_page = $validated['jml-halaman'];
        $book->category_id = $validated['kategori'];
        $book->author_id = $validated['nama-penulis-1'];
        $book->publisher_id = $validated['nama-penerbit'];
        $book->save();

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

    public function updateBook($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('admin.edit-buku', [
            'book' => $book,
            'categories' => $categories
        ]);
    }

    public function doLogout()
    {
        return redirect('/');
    }
}
