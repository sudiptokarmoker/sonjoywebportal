<?php
namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public $user;
    public $_UUID;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $total_roles = count(Role::select('id')->get());
        $total_admins = 1;
        $total_permissions = count(Permission::select('id')->get());
        return view('backend.pages.dashboard.index_v2', compact('total_admins', 'total_roles', 'total_permissions'));
    }
        /**
     * account settings page
     */
    public function accountSettings()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('account.settings')) {
            abort(403, 'Sorry !! You are Unauthorized to view account settings page!');
        }
        $user = Auth::user();
        $userMediaInfoModel = UsersMediaModel::where('user_id', Auth()->user()->id)->first();
        return view('backend.pages.dashboard.account_settings', compact('user', 'userMediaInfoModel'));
    }
}
