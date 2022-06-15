<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;


class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) {
            return redirect()->to('/dashboard');
        }
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $user = User::where('kode', $request->input('kode'))->first();

        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                Auth::login($user);
            }
            if (Auth::check()) {
                return redirect()->to('/dashboard');

            } else {
                Session::flash('error', 'kode atau password user salah');
                return redirect()->route('login');
            }
        }  else {
            Session::flash('error', 'Masukan kode atau Password');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
