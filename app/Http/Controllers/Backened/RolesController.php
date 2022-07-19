<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            /**
             * profile image data
             */
            /*
            $userProfileImage = \App\Models\Backened\UsersMediaModel::where('user_id', Auth::user()->id)->first();
            if ($userProfileImage) {
                \Illuminate\Support\Facades\View::share('profileImage', $userProfileImage->profile_image);
            }
            */
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
    public function index()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('roles.list', 'web')) {
            abort(403, 'Sorry !! You are Unauthorized to view roles lists page!');
        }
        if (Auth::user()->hasRole('superadmin')) {
            $roles = Role::all();
        } elseif (Auth::user()->hasRole('admin')) {
            $roles = Role::where('name', 'admin')->get();
        } elseif (Auth::user()->hasRole('user')) {
            $roles = Role::where('name', 'user')->get();
        } elseif (Auth::user()->hasRole('trainer')) {
            $roles = Role::where('name', 'trainer')->get();
        }
        /**
         * new data for
         */
        $permissions = Permission::all();
        $permissionGroup = User::getPermissionsGroupListData();
        /**
         * end
         */
        return view('backend.pages.roles.v2.index_roles_v2', compact('roles', 'permissions', 'permissionGroup'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('roles.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view roles create page!');
        }
        $roles = Role::all();
        $permissions = DB::table('permissions')->get();
        $permissionGroup = User::getPermissionsGroupListData();
        return view('backend.pages.roles.v2.create_roles_v2', compact('roles', 'permissions', 'permissionGroup'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('roles.save')) {
            abort(403, 'Sorry !! You are Unauthorized to save roles!');
        }
        $request->validate(
            [
                'name' => 'required|max:100|unique:roles',
            ],
            [
                'name.required' => 'Please give a role name',
            ]
        );
        $role = Role::create(['name' => $request->name]);
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        return back()->with('success', 'Role has been created successfully !!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('roles.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view roles edit form!');
        }
        $role = Role::findById($id);
        $permissions = Permission::all();
        $permissionGroup = User::getPermissionsGroupListData();
        return view('backend.pages.roles.edit', compact('role', 'permissions', 'permissionGroup'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('roles.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update roles!');
        }
        $request->validate(
            [
                'name' => 'required|max:100|unique:roles,name,' . $id,
            ],
            [
                'name.required' => 'Please give a role name',
            ]
        );
        $role = Role::findById($id);
        $role->name = $request->input('name');
        $role->update();

        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]);
        }
        return back()->with('success', 'Edited successfully');
    }

    /**0
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('roles.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete roles!');
        }
        $role = Role::findById($id);
        if (!is_null($role)) {
            $role->delete();
        }
        return back()->with('success', 'Role has been deleted !!');
    }
    /**
     * Method : multiple role submission form request post
     */
    public function multiple_role_submit(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('multiple.roles.permission.update')) {
            abort(403, 'Sorry !! You are Unauthorized to multiple roles permission control!');
        }
        try {
            /**
             * Get the all permission input selected by checkbox : $requestDataArray = $request->input('permissions') and then get all role lists by this : $rolesListsCollection = Role::all();
             */
            $requestDataArray = $request->input('permissions');
            $rolesListsCollection = Role::all();
            /**
             * First just we will just check something to handle the error if any. like, we need to check if
             */
            if (isset($requestDataArray) && count($requestDataArray) > 0 && count($rolesListsCollection) > 0) {
                /**
                 * $permission_array is for get all permission of all
                 */
                $permission_array = [];
                /**
                 * now just loop through the all roles list and then get there all existing permission. Actually this is may be lazy approach but this is usefull becuse we need to remove the existing all permission. and then need to setup the new selected permission
                 */
                foreach ($rolesListsCollection as $roleList) {
                    if ($roleList->name != 'superadmin') {
                        /**
                         * $listsArray for getting all permission of each roles : $roleList->getAllPermissions();
                         */
                        $listsArray = $roleList->getAllPermissions();
                        foreach ($listsArray as $permission_name) {
                            $permission_array[] = $permission_name->name;
                        }
                        /**
                         * now deleting all existing from this current permission
                         */
                        foreach ($permission_array as $permission_name) {
                            $roleList->revokePermissionTo($permission_name);
                        }
                    }
                }
                /**
                 * in this portion we will just insert the all selected permission checkbox to the all specific roles
                 */
                foreach ($rolesListsCollection as $index => $role) {
                    $init = ++$index;
                    if ($roleList->name != 'superadmin') {
                        if (isset($requestDataArray[$init])) {
                            foreach ($requestDataArray[$init] as $permission_name) {
                                $role->givePermissionTo($permission_name);
                            }
                        }
                    }
                }
            }
            return back()->with('success', 'Role has been created successfully !!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error occured while permission request processing!!');
        }
    }
    public function multiple_role_submit_bk_10_12_2020(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('multiple.roles.permission.update')) {
            abort(403, 'Sorry !! You are Unauthorized to multiple roles permission control!');
        }
        $requestDataArray = $request->input('permissions');
        $roles = Role::all();
        if (isset($requestDataArray) && count($requestDataArray) > 0 && count($roles)) {
            $init = 0;
            foreach ($roles as $index => $role) {
                $init = ++$index;
                if (isset($requestDataArray[$init])) {
                    foreach ($requestDataArray[$init] as $permission_name) {
                        $_permission = Permission::where('name', $permission_name)->first();
                        $_permission->assignRole($role);
                    }
                }
            }
        }
    }
}
