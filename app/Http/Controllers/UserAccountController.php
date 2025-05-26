<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserAccountController extends Controller
{
    public function loginView() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = UserAccount::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password) && $user->status === 'active') {
            Session::put('loggedUser', $user->id);

            if ($user->username === 'admin@example.com') {
                return redirect('/dashboard');
            } else {
                return redirect('/user-dashboard');
            }
        }

        return back()->with('error', 'Invalid credentials or inactive account.');
    }

    public function logout() {
        Session::forget('loggedUser');
        return redirect('/login');
    }

    public function updatePasswordView() {
        return view('updatePassword');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        $user = UserAccount::find(Session::get('loggedUser'));

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

    public function userDashboard() {
        $user = UserAccount::with('employee')->find(Session::get('loggedUser'));
        return view('user.dashboard', compact('user'));
    }
}
