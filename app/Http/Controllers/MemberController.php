<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use PHPUnit\Exception;

class MemberController extends Controller
{
    public function editCart(Request $request)
    {
        return $this->addToCart($request->input('book-id'));
    }

    private function addToCart($book_id): JsonResponse | \Illuminate\Http\Response
    {
        try {
            $cart = Cart::where('member_id', Session::get('id'))
                ->withCount('books')
                ->where('is_checkout', false)->first();


            if($cart){
                $isExist = $cart->books()->where('book_id', $book_id)->first();
                if($isExist){
                    return response()->json(['status' => 'oke', 'message' => 'Buku sudah berada di keranjang'], 200);
                }
                if($cart->books_count >= 3){
                    return response()
                        ->json(['status' => 'err', 'message' => 'Buku gagal ditambahkan karena melebihi 3'], 422);
                }
            }else{
                $member = Member::find(Session::get('id'));
                $cart = new Cart();
                $cart->member()->associate($member);
                $cart->save();
            }
            $cart->books()->syncWithoutDetaching($book_id);
            return response()->json(['status' => 'oke', 'message' => 'Buku berhasil ditambahkan'], 200);
        }catch (Exception $e){
            $cart = null;
            return response()->setStatusCode(200)->noContent();
        }
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
            $cart->created_at = Carbon::now();
            $cart->push();
            return redirect('/')->with('success', 'Checkout berhasil, nomor peminjaman adalah ' . $cart->id);
        }else{
            return redirect('/cart/detail')->with('err', 'Checkout minimal terdapat 1 buku');
        }
    }

    public function history()
    {
        $histories = Cart::where('member_id', \Auth::guard('member')->user()->id)->get();
        return \view('member.history-index', [
            'histories' => $histories
        ]);
    }

    public function doLogout():RedirectResponse
    {
        Session::flush();
        return redirect('/');
    }
}
