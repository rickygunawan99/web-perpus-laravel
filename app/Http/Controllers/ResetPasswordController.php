<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('reset-password');
    }

    public function store(Request $request)
    {
        $email = $request->input('email');

        $token = Str::uuid();

        DB::table('password_resets')
            ->insert([
                'token' => $token,
                'email' => $email
            ]);

        return redirect('/confirm-password?token=' . $token);
    }
}
