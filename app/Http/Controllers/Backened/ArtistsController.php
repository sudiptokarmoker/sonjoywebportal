<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ArtistsRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class ArtistsController extends Controller
{
    protected $artistsObj;
    public function __construct(ArtistsRepositoryInterface $artistsObjInterface)
    {
        $this->artistsObj = $artistsObjInterface;
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('artists.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access artits default list page!');
        }
        return view('backend.pages.artists.index_artists');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('artists.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to create artists!');
        }
        return view('backend.pages.artists.create_artists');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('artists.save')) {
            abort(403, 'Sorry !! You are unauthorized to create artists section!');
        }
        $request->validate([
            'name' => 'required|max:255',
            'name_in_bangla' => 'required|max:255',
            'email' => 'nullable|email|unique:artists_contact_details',
            'mobile' => 'max:32',
            'city' => 'max:32',
            'state' => 'max:32',
            'country' => 'max:32',
            'gender' => 'required|max:255',
            'date_of_birth' => 'required',
        ]);
        try {
            $this->artistsObj->save($request->all());
            return redirect(route('artists.index'))->with('status', 'Artists created successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('artists.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to access artists edit form page!');
        }
        $artistsEditedObject = $this->artistsObj->edit($id);
        return view('backend.pages.artists.edit_artists', compact('artistsEditedObject'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('artists.update')) {
            abort(403, 'Sorry !! You are Unauthorized to artists!');
        }
        $request->validate([
            'name' => 'required|max:255',
            'name_in_bangla' => 'required|max:255',
            'email' => 'nullable|email|unique:artists_contact_details,artists_id,'.$id,
            //'name' => 'required|max:100|unique:roles,name,' . $id,
            'mobile' => 'max:32',
            'city' => 'max:32',
            'state' => 'max:32',
            'country' => 'max:32',
            'gender' => 'required|max:255',
            'date_of_birth' => 'required',
        ]);
        try {
            $this->artistsObj->update($request->all(), $id);
            return redirect(route('artists.index'))->with('status', 'Artists updated successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('artists.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete artists!');
        }
        try {
            $delete = $this->artistsObj->delete($id);
            return redirect(route('artists.index'))->with('status', 'Artists deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function allArtists(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('artists.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access users default list page!');
        }
        if ($request->ajax()) {
            $data = $this->artistsObj->all();
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('created_at', function ($category) {
                //     $timeOfCreate = $category['created_at'];
                //     $getCreatedTime = new Carbon($timeOfCreate);
                //     $createdDateTime = $getCreatedTime->toDateTimeString();
                //     return $createdDateTime;
                // })
                ->addColumn('action', function ($artists) {
                    // This is correct format
                    $btn = '<a class="btn btn-info text-white" href=' . route("artists.edit", $artists['id']) . '>Edit</a>';
                    $token = csrf_token();
                    $btn .= '<a class="btn btn-danger text-white" href=' . route("artists.destroy", $artists['id']) . ' onclick="javascript:delete_form_processing(' . $artists['id'] . ');">Delete</a>
                    <form id="delete-form-' . $artists['id'] . '" action=' . route('artists.destroy', $artists['id']) . ' method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . $token . '"></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
