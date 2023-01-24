<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function chartMonthly($year): JsonResponse
    {
        $data = Cart::selectRaw('DATE_FORMAT(created_at, "%M") as month, count(cart_details.book_id) as count_book, month(created_at) as created')
                ->join('cart_details', 'id', "=",'cart_details.cart_id')
                ->groupBy('created')
                ->whereIn('is_approve', ['approve', 'returned'])
                ->whereYear('created_at', $year)
                ->get();
        return response()->json($data);
    }
}
