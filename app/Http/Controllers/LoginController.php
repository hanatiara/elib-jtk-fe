<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Login',
        ];

        return view('/login/v_login',$data);
    }

    public function authenticate(Request $request) {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);


        $response = Http::POST(env('BACKEND_URL')."/api/auth/login", [
            'username' => $request->username,
            'password' => $request->password,
        ]);

        $result = json_decode($response->body());

        if($result->success) {
            session()->put('user', [
                'authenticate' => true,
                'user' => $result->data,
                'token' => $result->token,
            ]);

            // dd(session('user'));

            return redirect('/')->with([
                'success' => $result->success,
                'message' => 'Selamat datang, ' . $result->data->username
            ]);

        }


        return back()->with('loginError', $result->message);
    }

    public function logout() {
        session()->forget('user');
        return redirect('/login');
    }

    public function resetPasswordForm() {
        $data = [
            'title' => 'Forgot Password',
        ];

        return view('/login/v_lupa-pass',$data);
    }

    public function resetPassword() {

    }
}
