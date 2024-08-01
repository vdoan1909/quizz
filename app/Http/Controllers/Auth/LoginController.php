<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    protected function authenticated(Request $request, $user)
    {
        Log::channel('customer')->info($user->name . ' đã đăng nhập thành công.');

        if ($user->role == 'admin') {
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('client.index');
        }

    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
