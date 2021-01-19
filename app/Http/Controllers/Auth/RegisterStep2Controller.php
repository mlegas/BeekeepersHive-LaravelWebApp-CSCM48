<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterStep2Controller extends Controller
{
    public function postForm(Request $request)
    {
        auth()->user()->update($request->only(['biography', 'country_id']));
        return redirect()->route('home');
    }

    public function showForm()
    {
        return view('auth.register_step2');
    }
}
