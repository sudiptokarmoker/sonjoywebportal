<?php

namespace App\Http\Controllers\backened;

use App\Http\Controllers\Controller;
use App\Models\Backened\CurrencyListsModel;
use App\Models\Backened\SiteSettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteSettingsController extends Controller
{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('site.settings.lists')) {
            abort(403, 'Sorry !! You are Unauthorized to view site settings page!');
        }
        $site_settings_data = SiteSettingsModel::all();
        /**
         * currency model details here
         */
        if ($this->user->hasPermissionTo('currency.lists')) {
            $currencyLists = CurrencyListsModel::all();
        } else {
            $currencyLists = [];
        }
        /**
         * end of currency details model
         */
        // get the question list and render here || here role need to check but we will do that later
        return view('backend.pages.site_settings.index_site_settings', compact('site_settings_data', 'currencyLists'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('site.settings.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create site settings data!');
        }
        return view('backend.pages.site_settings.create_site_settings');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('site.settings.create')) {
            abort(403, 'Sorry !! You are Unauthorized to save create any settings data!');
        }
        $request->validate([
            'module_identifier' => 'required|max:255|unique:site_settings',
            'param' => 'required|max:255',
            'param_value' => 'required|max:255',
        ]);
        try {
            SiteSettingsModel::create(
                [
                    'module_identifier' => $request->module_identifier,
                    'param' => $request->param,
                    'param_value' => $request->param_value,
                ]
            );
            return redirect()->route('site-settings.index')->with('success', 'created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('site.settings.update')) {
            abort(403, 'Sorry !! You are Unauthorized to edit site settings data');
        }
        $site_settings_edit_data = SiteSettingsModel::findOrFail($id);
        return view('backend.pages.site_settings.edit_site_settings', compact('site_settings_edit_data'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('site.settings.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update site settings data!');
        }
        $request->validate([
            'module_identifier' => 'required|max:255|unique:site_settings,module_identifier,' . $id,
            'param' => 'required|max:255',
            'param_value' => 'required|max:255',
        ]);
        try {
            SiteSettingsModel::where('id', $id)
                ->update([
                    'module_identifier' => $request->module_identifier,
                    'param' => $request->param,
                    'param_value' => $request->param_value,
                ]);
            return redirect()->route('site-settings.index')->with('success', 'Site Settings Updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Not found this site settings data');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('site.settings.delete')) {
            abort(403, 'Sorry !! You are Unauthorized site settings data!');
        }
        $siteSettingsModel = SiteSettingsModel::find($id);
        if (!is_null($siteSettingsModel)) {
            /**
             * Delete category image if any
             */
            $siteSettingsModel->delete();
            return back()->with('warning', 'Site Settings interest category has been deleted !!');
        } else {
            return back()->with('error', 'Error while delete site settings data');
        }
    }
}
