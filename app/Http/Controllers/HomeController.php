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
        if(!$request->input('s')){
            return view('dashboard', [
                'book_recomendation' => Book::limit(3)->get()->shuffle(),
                'books' => Book::limit(6)->get()->shuffle(),
                'categories' => Category::limit(5)->get()->shuffle()
            ]);
        }else{
            $search = $request->input('s');

            $byAuthor =  Book::whereHas('author', function ($query) use ($search) {
               return $query->where('name', 'LIKE', "%$search%");
            })->get();
            return view('dashboard-search', [
               'books' => Book::where('title','like', "%{$search}%")->get(),
               'byAuthor' => $byAuthor
            ]);
        }
    }

    public function detailBook($id): View
    {
        return view('detail-book', [
            'book' => Book::find($id)
        ]);
    }

    public function login(): View
    {
        return view('member.login');
    }

    public function doLogin(Request $request): \Illuminate\Contracts\View\Factory|View|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:members,email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/login')->withErrors($validator);
        }
        $validated = $validator->safe()->all();
        $member = Member::where('email', $validated['email'])->first();

        if(!$member || !Hash::check($validated['password'], $member->password)){
            return redirect('/login')->with('err', 'email and password not found');
        }

        session(['role'=>'member', 'id'=>$member->id]);
        return redirect('/');
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
