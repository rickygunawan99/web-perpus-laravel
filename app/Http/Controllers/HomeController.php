<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\String\b;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $books = Book::query();
        if($request->input('s')){
            $search = $request->input('s');

            $books->where('title', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%")
                ->orWhereHas('author', function ($query) use ($search) {
                    return $query->where('name', 'LIKE', "%$search%");
                });
        }

        $books = $books->paginate(5);

        return view('dashboard', [
            'books' => $books
        ]);
    }

    public function detailBook($id): View
    {
        return view('detail-book', [
            'book' => Book::find($id)
        ]);
    }

    public function login(): View
    {
        return view('login');
    }

    public function doLogin(Request $request): \Illuminate\Contracts\View\Factory|View|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $credentials = $request->validate([
            'email' => 'required|exists:members,email',
            'password' => 'required'
        ]);

        if(Auth::guard('member')->attempt($credentials)){
            $member = Auth::guard('member')->user();

            Auth::guard('member')->login($member);

            session(['role'=>'member', 'id'=>$member->id]);

            return redirect()->intended();
        }

        return redirect('/login')->withErrors([
            'email' => 'Email dan password tidak ditemukan'
        ])->onlyInput('email');

    }

    public function dashboard()
    {
        if(\Session::get('role') == 'admin'){
            return redirect('/admin');
        }else{
            return redirect('/');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function doRegister(RegisterRequest $request)
    {
        $validated = $request->validated();

        Member::create($validated);

        return redirect('/login')
            ->with(['success' => 'registrasi berhasil, silahkan login']);
    }
}
