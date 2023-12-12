<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConfirmResetPasswordController extends Controller
{
    public function index(Request $request)
    {
        $user = DB::table('password_resets')
            ->where('token', $request->input('token'))
            ->first();

        if(!$user){
            return abort(404);
        }
        return view('confirm-reset');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new' => 'required',
            'confirm_new' => 'required|same:new'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $validated = $validator->safe()->only(['new', 'confirm_new']);

        $email = DB::table('password_resets')->where('token', $request->input('token'))->first('email');

        DB::table('password_resets')->where('token', $request->input('token'))->delete();

        Member::where('email', $email->email)
            ->update([
                'password' => bcrypt($validated['new'])
            ]);

        return redirect('/')
            ->with([
                'status' => 'success',
                'message' => 'berhasil reset password'
            ]);
    }
}
