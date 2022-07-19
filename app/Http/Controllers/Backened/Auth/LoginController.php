<?php

namespace App\Http\Controllers\Backened\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    public function showLoginForm(Request $request)
    {
        /**
         * check if user logged in
         */
        if (Auth::user()) {
            return redirect(route('admin.dashboard'));
        } else {
            /**
             * modified code for session flush of password redirection
             * otherwise old code : return view('backend.auth.login_v2');
             */
            $value = $request->session()->get('forgetEmailSent');
            if ($value == true) {
                $request->session()->put('forgetEmailSent', false);
                return view('backend.auth.blank_flush_message_page');
            } else {
                return view('backend.auth.login_v2');
            }
        }
    }

    public function login(Request $request)
    {
        /**
         * check if user logged in
         */
        if (Auth::user()) {
            return redirect(route('admin.dashboard'));
        }
        // Validate Login Data
        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required'
        ]);
        //if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isAdmin' => 1], $request->remember)) {
            //if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if (Auth::user()->isAdmin != 1) {
            //     Auth::logout();
            //     return redirect()->route('admin.login')->with('error', 'You are not authrized to access the dashboard page');
            //     exit();
            // }

            // Redirect to dashboard 
            //session()->flash('success', 'Successully Logged in !');
            return redirect()->intended(route('admin.dashboard'))->with('success', 'welcome to dashboard');
        } else {
            //session()->flash('error', 'Invalid email and password');
            return back()->with('error', 'Invalid email or password | Unauthorized User');
        }
    }

    /**
     * logout admin guard
     *
     * @return void
     */
    public function logout()
    {
        //Auth::guard('admin')->logout();
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
