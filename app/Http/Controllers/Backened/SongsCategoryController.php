<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SongsCategoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class SongsCategoryController extends Controller
{
    protected $songsCategoryObj;
    public function __construct(SongsCategoryRepositoryInterface $songsCategoryObjInterface)
    {
        $this->songsCategoryObj = $songsCategoryObjInterface;
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('songs_category.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access songs category default list page!');
        }
        return view('backend.pages.songs_category.index_songs_category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('songs_category.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to create songs category default list page!');
        }
        return view('backend.pages.songs_category.create_songs_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('posts_category.save')) {
            abort(403, 'Sorry !! You are unauthorized to create course section!');
        }
        $request->validate([
            'category_name' => 'required|max:255',
            'category_name_bangla' => 'required|max:255',
        ]);
        try {
            $this->songsCategoryObj->save($request->all());
            return redirect(route('songs_category.index'))->with('status', 'Songs category created successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('songs_category.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to access song category edit form page!');
        }
        $songs_category = $this->songsCategoryObj->edit($id);
        return view('backend.pages.songs_category.edit_songs_category', compact('songs_category'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('songs_category.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update songs category!');
        }
        $request->validate([
            'category_name' => 'required|max:255',
            'category_name_bangla' => 'required|max:255',
        ]);
        try {
            $this->songsCategoryObj->update($request->all(), $id);
            return redirect(route('songs_category.index'))->with('status', 'Songs category updated successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('songs_category.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete category!');
        }
        try {
            $delete = $this->songsCategoryObj->delete($id);
            return redirect(route('songs_category.index'))->with('status', 'Songs category deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function allSongsCatetoryLists(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('songs_category.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access songs category default list page!');
        }
        if ($request->ajax()) {
            $data = $this->songsCategoryObj->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($category) {
                    $timeOfCreate = $category['created_at'];
                    $getCreatedTime = new Carbon($timeOfCreate);
                    $createdDateTime = $getCreatedTime->toDateTimeString();
                    return $createdDateTime;
                })
                ->addColumn('action', function ($category) {
                    // This is correct format
                    $btn = '<a class="btn btn-info text-white" href=' . route("songs_category.edit", $category['id']) . '>Edit</a>';
                    $token = csrf_token();
                    $btn .= '<a class="btn btn-danger text-white" href=' . route("songs_category.destroy", $category['id']) . ' onclick="javascript:delete_form_processing(' . $category['id'] . ');">Delete</a>
                    <form id="delete-form-' . $category['id'] . '" action=' . route('songs_category.destroy', $category['id']) . ' method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . $token . '"></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
