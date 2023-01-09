<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function editCart(Request $request)
    {
        if($request->input('action') == 'save'){
            $this->addToCart($request->input('book-id'));
        }else if($request->input('action') == 'delete'){
            $this->deleteFromCart($request->input('book-id'));
        }
    }

    private function addToCart($book_id)
    {
        $cart = Cart::where('member_id', Session::get('id'))
            ->where('is_checkout', false)->first();

        if(!$cart){
            $member = Member::find(Session::get('id'));
            $cart = new Cart();
            $cart->member()->associate($member);
            $cart->save();
        }
        $cart->books()->syncWithoutDetaching($book_id);
    }

    public function deleteFromCart(Request $request)
    {

    }

    public function cartDetail():View
    {
        return view('member.cart-detail', [
            'cart' => Cart::where('member_id', Session::get('id'))->first()
        ]);
    }

    public function doLogout():RedirectResponse
    {
        session()->flush();
        return redirect('/');
    }
}
