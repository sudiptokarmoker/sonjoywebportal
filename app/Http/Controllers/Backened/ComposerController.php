<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ComposerRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class ComposerController extends Controller
{
    protected $composerObj;
    public function __construct(ComposerRepositoryInterface $composerObj)
    {
        $this->composerObj = $composerObj;
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('composer.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access artits default list page!');
        }
        return view('backend.pages.composer.index_composer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('composer.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to create composer!');
        }
        return view('backend.pages.composer.create_composer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('composer.save')) {
            abort(403, 'Sorry !! You are unauthorized to create composer section!');
        }
        $request->validate([
            'name' => 'required|max:255',
            'name_in_bangla' => 'required|max:255',
            'email' => 'nullable|email|unique:composer_contact_details',
            'mobile' => 'max:32',
            'city' => 'max:32',
            'state' => 'max:32',
            'country' => 'max:32',
            // 'gender' => 'required|max:255',
            // 'date_of_birth' => 'required'
        ]);
        try {
            $this->composerObj->save($request->all());
            return redirect(route('composer.index'))->with('status', 'Composer created successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('composer.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to access composer edit form page!');
        }
        $composerEditedObject = $this->composerObj->edit($id);
        return view('backend.pages.composer.edit_composer', compact('composerEditedObject'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('composer.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update composer!');
        }
        $request->validate([
            'name' => 'required|max:255',
            'name_in_bangla' => 'required|max:255',
            'email' => 'nullable|email|unique:composer_contact_details,email,' . $request->contact_details_id,
            //'name' => 'required|max:100|unique:roles,name,' . $id,
            'mobile' => 'max:32',
            'city' => 'max:32',
            'state' => 'max:32',
            'country' => 'max:32',
            // 'gender' => 'required|max:255',
            // 'date_of_birth' => 'required',
        ]);
        try {
            $this->composerObj->update($request->all(), $id);
            return redirect(route('composer.index'))->with('status', 'Composer updated successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('composer.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete composer!');
        }
        try {
            $delete = $this->composerObj->delete($id);
            return redirect(route('composer.index'))->with('status', 'Composer deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function allComposer(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('composer.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access composer default list page!');
        }
        if ($request->ajax()) {
            $data = $this->composerObj->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($artists) {
                    // This is correct format
                    $btn = '<a class="btn btn-info text-white" href=' . route("composer.edit", $artists['id']) . '>Edit</a>';
                    $token = csrf_token();
                    $btn .= '<a class="btn btn-danger text-white" href=' . route("composer.destroy", $artists['id']) . ' onclick="javascript:delete_form_processing(' . $artists['id'] . ');">Delete</a>
                    <form id="delete-form-' . $artists['id'] . '" action=' . route('composer.destroy', $artists['id']) . ' method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . $token . '"></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
