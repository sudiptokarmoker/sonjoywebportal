<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserSettingsController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            /**
             * profile image data
             */
            $userProfileImage = \App\Models\Backened\UsersMediaModel::where('user_id', Auth::user()->id)->first();
            if ($userProfileImage) {
                \Illuminate\Support\Facades\View::share('profileImage', $userProfileImage->profile_image);
            }
            /**
             * end profile image data
             */
            return $next($request);
        });
    }
    /**
     * Default page of listing
     */
    public function index(Request $request)
    {
        try {
            if (is_null($this->user) || !$this->user->hasPermissionTo('user.settings.view')) {
                abort(403, 'Sorry !! You are Unauthorized to access users settings page!');
            }
            /**
             * User load
             */
            $userDataLoad = DB::table('users')
                ->leftJoin('users_profile_media', 'users_profile_media.id', '=', 'users.id')
                ->select('users.id', 'users.email', 'users.full_name', 'users_profile_media.profile_image')
                ->where('users.id', '=', Auth::user()->id)
                ->first();
            return view('backend.pages.user_settings.index_user_settings_v2', compact('userDataLoad'));
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', $e->getMessage());
        }
    }
    /**
     * User request update form
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('user.settings.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update users settings!');
        }
        try {
        } catch (\Exception $e) {
        }
    }
}
