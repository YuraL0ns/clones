<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function adminLoginForm()
    {
        if (Auth::check() && Auth::user()->hasRole(['Администратор', 'Директор', 'Инжинер'])) {
            return redirect()->route('admin.dashboard.main');
        } else {
            return view('admin.auth.login');
        }
    }

    public function adminLogin(Request $request)
    {
        if (Auth::check() && Auth::user()->hasRole(['Администратор', 'Директор', 'Инжинер'])) {
            return redirect()->route('admin.dashboard.main');
        } else {
            $user = User::query()->where('email', $request->get('email'))->first();
            if ($user && !$user->hasRole(['Администратор', 'Директор', 'Инжинер'])) {
                return $this->sendFailedLoginResponse(request());
            }
            if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
                return redirect()->route('admin.dashboard.main');
            } else {
                return $this->sendFailedLoginResponse(request());
            }
        }
    }
}
