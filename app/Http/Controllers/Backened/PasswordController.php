<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use App\Models\Backened\PasswordResetsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PasswordController extends Controller
{
    public function generatePasswordResetForm()
    {
        return view('backend.auth.password_reset_form');
    }
    public function forgetPasswordEmailHandler(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        /**
         * first check the validate if this user is valid and its role is ?
         */
        $user = User::role(['admin', 'superadmin'])->where('email', $request->email)->where('isAdmin', 1)->first();
        if ($user == null) {
            return back()->with('error', 'Sorry, user not found on this email');
        }
        //Create Password Reset Token
        $passwordResetCreatedInstance = PasswordResetsModel::create([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => now(),
        ]);
        if ($passwordResetCreatedInstance) {
            $request->session()->put('forgetEmailSent', true);
            return redirect(route('admin.login'))->with('success', 'Email sent. Please check your email.');
        } else {
            return redirect(route('admin.password.forget'))->with('error', 'Error while reset token generate. Try again.');
        }
    }
    /**
     * forget password verify and sset new password
     */
    public function resetNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.password.forget'))->withErrors($validator);
        }
        /**
         * now validate token and generate the form
         */
        $tokenValidationCheck = PasswordResetsModel::where('token', $request->token)->where('email', $request->email)->first();
        if ($tokenValidationCheck == null) {
            return redirect(route('admin.password.forget'))->with('error', 'Forget password reset requiest not valid');
        }
        // render reset form
        return view('backend.auth.new_password_reset_form', [
            'email' => $request->email,
            'token' => $request->token,
        ]);
    }
    /**
     * new password process
     */
    public function newPasswordProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required',
            //'password' => 'required|confirmed|min:8',
            'password' => 'required|confirmed|min:6|max:16|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            //'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        /**
         * now validate token and generate the form
         */
        $tokenValidationCheck = PasswordResetsModel::where('token', $request->token)->where('email', $request->email)->first();
        if ($tokenValidationCheck == null) {
            // it means that if this not found then go back to first step
            return redirect(route('admin.password.forget'))->with('error', 'Forget password reset request not valid');
        }
        /**
         * now if all are valid then save this new password
         */
        $user = User::where('email', $request->email)->firstOrFail();
        $newHashPassword = Hash::make($request->password);
        $user->password = $newHashPassword;
        $user->update();
        /**
         * now needs to remove the all token of this user
         */
        PasswordResetsModel::where('email', $request->email)->delete();
        /**
         * redirect to admin login page
         */
        return redirect(route('admin.login'))->with('success', 'Password reset successfully. Now you can logged in with your new email and password');
    }
}
