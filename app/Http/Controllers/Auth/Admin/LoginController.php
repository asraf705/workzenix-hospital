<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::guard('admin')->attempt([$loginType => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            return redirect()->route('admin.dashboard')->with('success', 'You are logged in successfully.');
        }

        return back()->with('error', 'Whoops! Invalid credentials.');
    }

    public function addAdmin(Request $request)
    {
        return view('admin.auth.register');
    }

    public function createAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:admins',
            'phone' => 'string|max:15|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = bcrypt($request->password);
        $admin->role = $request->role;;
        $admin->save();

        return redirect()->back()->with('success', 'Admin registered successfully. Please login.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->with('error', 'Old password does not match.');
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = bcrypt($request->password);
        $admin->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }


    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::put('success', 'You are logout sucessfully');
        return redirect('/admin/login');
    }
}
