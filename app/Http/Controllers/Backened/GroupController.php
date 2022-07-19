<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use App\Models\Backened\PermissionGroupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
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
            }*/
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('group.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access group lists page!');
        }
        $permmission_group = PermissionGroupModel::all();
        return view('backend.pages.group.v2.index_group_v2', compact('permmission_group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('group.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view group create page!');
        }
        return view('backend.pages.group.v2.create_group_v2');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('group.save')) {
            abort(403, 'Sorry !! You are Unauthorized to save group!');
        }
        $request->validate(
            [
                'group_name' => 'required|max:100|unique:permissions_group',
            ],
            [
                'group_name.required' => 'Please give a permissions group name',
            ]
        );
        DB::table('permissions_group')->insert(
            ['group_name' => $request->group_name]
        );
        return back()->with('success', 'created successfully');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('group.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view group edit form!');
        }
        $groupModel = PermissionGroupModel::findOrFail($id);
        return view('backend.pages.group.v2.edit_group_v2', compact('groupModel'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('group.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update group!');
        }

        $request->validate(
            [
                'group_name' => 'required|max:100|unique:permissions_group,group_name,' . $id,
            ],
            [
                'group_name.required' => 'Please give a permissions group name',
            ]
        );
        try {
            DB::table('permissions_group')->where('id', $id)
                ->update(['group_name' => $request->group_name]);
            /**
             * now check if this succes or fail
             */
            return redirect()->route('group.index')->with('success', 'Edited successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('group.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete group!');
        }

        try {
            $permissionGroupModel = PermissionGroupModel::findOrFail($id);
            $permissionGroupModel->delete();
            return back()->with('success', 'Permission Group has been deleted !!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
