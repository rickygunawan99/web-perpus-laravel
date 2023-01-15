<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function editCart(Request $request)
    {
        return $this->addToCart($request->input('book-id'));
    }

    private function addToCart($book_id): JsonResponse
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
        return response()->json(['status'=>'oke']);
    }

    public function deleteFromCart(Request $request, $id): RedirectResponse
    {
        try {
            $book = Book::find($id);

            $cart = Cart::where('member_id', Session::get('id'))
                ->where('is_checkout', false)->first();

            $cart->books()->detach($book);
            return redirect()->action([MemberController::class, 'cartDetail'])->with('success', 'Hapus buku dari keranjang berhasil');
        }catch (\Exception $e){
            return redirect()->action([MemberController::class, 'cartDetail'])->with('err', $e->getMessage());
        }

    }

    public function cartDetail():View
    {
        return view('member.cart-detail', [
            'cart' => Cart::where('member_id', Session::get('id'))->where('is_checkout', false)->first()
        ]);
    }

    public function checkout(Request $request):RedirectResponse
    {
        $cart = Cart::where('member_id', Session::get('id'))
            ->where('is_checkout', false)->withCount('books')->first();

        if($cart){
            $cart->is_checkout = true;
            $cart->total_day = $request->input('total-borrow');
            $cart->push();
            return redirect('/')->with('success', 'Checkout berhasil, nomor peminjaman adalah ' . $cart->id);
        }else{
            return redirect('/cart/detail')->with('err', 'Checkout minimal terdapat 1 buku');
        }
    }

    public function doLogout():RedirectResponse
    {
        Session::flush();
        return redirect('/');
    }
}
