<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('permission.list')) {
            abort(403, 'Sorry !! You are Unauthorized to view permission lists page!');
        }
        //$permissionModel = Permission::all()->sortBy('group_name');
        $permissionModel = DB::table('permissions')
            ->join('permissions_group', 'permissions.group_id', '=', 'permissions_group.id')
            ->select('permissions.id as permission_main_id', 'permissions.name', 'permissions.guard_name', 'permissions_group.id as permission_group_id', 'permissions_group.group_name')
            ->orderBy('permissions_group.group_name')
            ->get();
        //print_r($permissionModel);
        //return view('backend.pages.permission_group.index', compact('permissionModel'));
        return view('backend.pages.permission_group.v2.index_permission_v2', compact('permissionModel'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('permission.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view permission create page!');
        }
        $permissionGroupName = DB::table('permissions_group')->get();
        return view('backend.pages.permission_group.v2.create_permission_v2', compact('permissionGroupName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('permission.save')) {
            abort(403, 'Sorry !! You are Unauthorized to save permission!');
        }

        $request->validate(
            [
                'lstGroupNameOnStore' => 'required',
                'txtPermissionRouteName' => 'required|max:100',
            ],
            [
                'lstGroupNameOnStore.required' => 'Please select group name',
            ]
        );
        // check if this two match with db already
        $checkTwoCombination = Permission::select('*')
            ->where('group_id', '=', $request->lstGroupNameOnStore)
            ->where('name', '=', $request->txtPermissionRouteName)
            ->first();

        if ($checkTwoCombination) {
            return back()->withError('This route and this group is already exits');
        } else {
            Permission::create([
                'name' => $request->txtPermissionRouteName,
                'group_id' => $request->lstGroupNameOnStore,
            ]);
            /**
             * direct set this permission to
             */
            //$permission = Permission::where('name', 'superadmin')->get();
            $role_model = Role::where('name', 'superadmin')->first();
            $permission_model = Permission::where('name', $request->txtPermissionRouteName)->first();
            $role_model->givePermissionTo($permission_model);
            /**
             * end
             */
            return redirect()->route('permission.index')->with('success', 'successfully created');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('permission.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view permission edit form!');
        }

        $permission = Permission::findById($id);
        $permissionGroup = DB::table('permissions_group')->get();
        $permissionGroupName = DB::table('permissions')
            ->join('permissions_group', 'permissions.group_id', '=', 'permissions_group.id')
            ->get();
        return view('backend.pages.permission_group.v2.edit_permission_v2', compact('permission', 'permissionGroupName', 'permissionGroup'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('permission.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update permission!');
        }

        $request->validate(
            [
                'lstGroupNameOnStore' => 'required|max:100|unique:permissions,name,' . $id,
                'txtPermissionRouteName' => 'required|max:100',
            ],
            [
                'lstGroupNameOnStore.required' => 'Please select group name',
            ]
        );
        $checkTwoCombination = Permission::select('*')
            ->where('id', '!=', $id)
            ->where('group_id', '=', $request->lstGroupNameOnStore)
            ->where('name', '=', $request->txtPermissionRouteName)
            ->first();

        if ($checkTwoCombination) {
            return back()->withError('This route and this group is already exits');
        } else {
            $permissionModel = Permission::find($id);
            $permissionModel->name = $request->txtPermissionRouteName;
            $permissionModel->group_id = $request->lstGroupNameOnStore;
            $permissionModel->save();

            return redirect()->route('permission.index')->with('success', 'successfully updated');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('permission.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete permission!');
        }

        $permission = Permission::findById($id);
        if (!is_null($permission)) {
            $permission->delete();
        }
        return back()->with('success', 'Permission has been deleted !!');
    }
}
