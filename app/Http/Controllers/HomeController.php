<?php

namespace App\Http\Controllers;

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
    public function index(): View
    {
        return view('dashboard', [
            'book_recomendation' => Book::limit(4)->get()->shuffle(),
            'books' => Book::all()->shuffle(),
            'categories' => Category::limit(5)->get()->shuffle()
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
}
