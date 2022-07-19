<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use App\Models\User;
//use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            /**
             * profile image data
             */
            // $userProfileImage = \App\Models\Backened\UsersMediaModel::where('user_id', Auth::user()->id)->first();
            // if ($userProfileImage) {
            //     \Illuminate\Support\Facades\View::share('profileImage', $userProfileImage->profile_image);
            // }
            /**
             * end profile image data
             */
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access users default list page!');
        }
        return view('backend.pages.users.v2.users_grid');
    }
    /**
     * this is for debugging issues for datable
     */
    /**
     * This is following was our old pagination style. here all data was being loadded once time. But the above method is perfect where it can load by ajax and load at server end on based on request. So we are using the above function
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.create.form')) {
            abort(403, 'Sorry !! You are Unauthorized to view users created form!');
        }
        if (Auth::user()->hasRole('superadmin')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'superadmin')->get();
        }
        return view('backend.pages.users.v2.create_users_v2', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.save')) {
            abort(403, 'Sorry !! You are Unauthorized to create any user!');
        }
        $request->validate(
            [
                'first_name' => 'required|max:255',
                'last_name' => 'max:255',
                'email' => 'required|max:100|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ]
        );
        try {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->isAdmin = true;
            $user->verified = 1;
            $user->uid = (string) Str::uuid();
            $user->save();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }
            /**
             * End of inserting mobile number into the system
             */
            $request->session()->flash('success', 'User has been created');
            return back();
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view user edit form!');
        }
        $user = User::find($id);
        $permissions = Permission::all();
        /**
         * It has been modified for if user is not superadmin
         */
        if (Auth::user()->hasRole('superadmin')) {
            $roles = Role::all();
            $permissionGroup = User::getPermissionsGroupListData();
        } else {
            $roles = Role::where('name', '!=', 'superadmin')->get();
            $permissionGroup = User::getPermissionsGroupListDataWithoutSuperAdminGroupLists();
        }
        $permission_name_list = User::rolePermissionNameListInArray($user);
        return view('backend.pages.users.v2.edit_users_v2', compact('user', 'roles', 'permissions', 'permissionGroup', 'permission_name_list'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update user!');
        }
        if ($request->password) {
            $request->validate(
                [
                    'first_name' => 'required|max:255',
                    'last_name' => 'max:255',
                    'password' => 'required|min:6|confirmed',
                ]
            );
        } else {
            $request->validate(
                [
                    'first_name' => 'required|max:255',
                    'last_name' => 'max:255',
                ]
            );
        }
        try {
            $user = User::find($id);
            if ($user) {
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();
                /**
                 * End of updating mobile number
                 */
                if (Auth::user()->hasRole('superadmin')) {
                    $user->roles()->detach();
                    if ($request->roles) {
                        $user->assignRole($request->roles);
                    }
                }
                /**
                 * now setting manual permission
                 */
                $permissionListsArray = $user->getAllPermissions();
                $permission_array = [];
                foreach ($permissionListsArray as $permission_name) {
                    $permission_array[] = $permission_name->name;
                }
                foreach ($permission_array as $permissionName) {
                    $user->revokePermissionTo($permissionName);
                }
                $user->syncPermissions();
                $requestDataArray = $request->input('permissions');
                if (isset($requestDataArray) && count($requestDataArray) > 0) {
                    foreach ($requestDataArray as $permission_data) {
                        $user->givePermissionTo($permission_data);
                    }
                }
                /**
                 * End of setting permission
                 */
                $request->session()->flash('success', 'User has been edited');
                return back();
            } else {
                $request->session()->flash('error', 'User not found');
                return back();
            }
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to disable any user!');
        }
        try {
            $user = User::find($id);
            if (!is_null($user)) {
                $user->delete();
                return back()->with('warning', 'User deleted!');
            } else {
                return back()->with('error', "User not found");
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    /**
     *  user hard delete code.
     */
    public function destroy_by_hard_delete(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.destroyByHardDelete')) {
            abort(403, 'Sorry !! You are Unauthorized to hard delete any user!');
        }
        try {
            $user = User::find($id);
            if (!is_null($user)) {
                $user->forceDelete();
                $request->session()->flash('success', 'User has been hard delete successfully');
                return back();
            } else {
                return back()->with('error', 'User not found');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function restore_user(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.restore')) {
            abort(403, 'Sorry !! You are Unauthorized to access users restore page!');
        }
        $users = User::onlyTrashed()->get();
        $roles = Role::all();
        return view('backend.pages.users.v2.restore_users_v2', compact('users', 'roles'));
    }
    /**
     * Restore user process
     */
    public function restore_user_process(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.restoreUserProcessing')) {
            abort(403, 'Sorry !! You are Unauthorized to access restore user!');
        }
        try {
            User::onlyTrashed()->where('id', $id)->restore();
            $request->session()->flash('success', 'User has been activated again successfully');
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
        }
        return back();
    }
    /**
     * Get all users list for server side renderring of datatable
     */
    public function allUser_bk(Request $request)
    {
        if (Auth::user()->hasRole('superadmin')) {
            $users = User::orderBy('id', 'asc')->get();
        } else {
            $users = User::whereHas('roles', function ($query) {
                return $query->where('name', '!=', 'superadmin');
            })->orderBy('id', 'asc')->get();
        }
        $roles = Role::all();
        return view('backend.pages.users.v2.index_users_v2', compact('users', 'roles'));
    }

    public function allUser(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access users default list page!');
        }
        if ($request->ajax()) {
            if (Auth::user()->hasRole('superadmin')) {
                $data = User::orderBy('created_at', 'desc')->get();
            } else {
                $data = User::whereHas('roles', function ($query) {
                    return $query->where('name', '!=', 'superadmin');
                })->orderBy('created_at', 'desc')->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function ($user) {
                    $role_name = '';
                    foreach ($user->getRoleNames() as $role) {
                        $role_name .= $role . ', ';
                    }
                    return rtrim($role_name, ", ");
                })
                ->addColumn('created_at', function ($user) {
                    $timeOfCreate = $user->created_at;
                    $getCreatedTime = new Carbon($timeOfCreate);
                    $createdDateTime = $getCreatedTime->toDateTimeString();
                    return $createdDateTime;
                })
                ->addColumn('action', function ($user) {
                    // This is correct format
                    $btn = '<a class="btn btn-info text-white" href=' . route("users.edit", $user->id) . '>Edit</a>';
                    $user_role_array = [];
                    foreach ($user->getRoleNames() as $role) {
                        $user_role_array[] = $role;
                    }
                    if (!in_array('superadmin', $user_role_array)) {
                        $token = csrf_token();
                        $btn .= '<a class="btn btn-danger text-white" href=' . route("users.destroy", $user->id) . ' onclick="javascript:delete_form_processing(' . $user->id . ');">Disable User</a>
                        <form id="delete-form-' . $user->id . '" action=' . route('users.destroy', $user->id) . ' method="POST" style="display: none;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="' . $token . '"></form>';
                        $btn .= '<a class="btn btn-link" href="' . route('users.destroy_by_hard_delete', $user->id) . '" onclick="javascript:void(0)">Permanently Delete User</a>
                        <form id="hard-delete-form-' . $user->id . '" action="' . route('users.destroy_by_hard_delete', $user->id) . '" method="POST" style="display: none;">
                            <input type="hidden" name="_method" value="GET">
                            <input type="hidden" name="_token" value="' . $token . '">
                        </form>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
