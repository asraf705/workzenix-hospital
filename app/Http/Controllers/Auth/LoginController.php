<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('user')->attempt($credentials, $request->get('remember'))) {
            return redirect()->route('user.dashboard')->with('success','You are Logged in sucessfully.');
        }
        else {
            return back()->with('error','Whoops! invalid email and password.');
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('user')->logout();
        $request->session()->regenerateToken();
        Session::put('success', 'You are logout sucessfully');
        return redirect('/login');
    }

}
