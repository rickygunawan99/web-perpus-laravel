<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.dashboard', [
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

    public function doLogout(): RedirectResponse
    {
        return redirect('/');
    }
}
