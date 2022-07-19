<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\VersesRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class VersesController extends Controller
{
    protected $versesObj;
    public function __construct(VersesRepositoryInterface $versesObjInterface)
    {
        $this->versesObj = $versesObjInterface;
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('songs.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access verses default list page!');
        }
        return view('backend.pages.verses.index_verses');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_lists = $this->versesObj->getAllVersesCategoryLists();
        $versesRootCategoryId = $this->versesObj->getVersesCategoryId();
        $artists_lists = $this->versesObj->getArtistsListsData();
        $composer_lists = $this->versesObj->getComposerListsData();
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to create verses create page!');
        }
        return view('backend.pages.verses.create_verses', compact('versesRootCategoryId', 'category_lists', 'artists_lists', 'composer_lists'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses.save')) {
            abort(403, 'Sorry !! You are unauthorized to store verses!');
        }
        $request->validate([
            'category_id' => 'required|max:255',
            'root_category_id' => 'required|integer',
            'title' => 'required|max:255',
            'title_in_english' => 'required|max:255',
            'content' => 'required',
            'rag' => 'max:255',
            'tal' => 'max:255',
            //'composition_time_english' => 'date',
            'composer_id' => 'integer',
            //'composition_time_english' => 'integer',
            //'composition_time_bangla' => 'integer',
            'composition_place' => 'max:255',
            'notation' => 'max:255',
            'posts_notation_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'posts_youtube_video_url' => 'nullable|url'
        ]);
        try {
            //dd($request->all());
            $postInsert = $this->versesObj->save($request->all());
            return redirect(route('verses.index'))->with('status', 'Verses Category Successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses_category.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to access verses edit form page!');
        }
        $verses_edit_obj = $this->versesObj->edit($id);
        //dd($songs_edit_obj);
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view edit verses page!');
        }
        return view('backend.pages.verses.edit_verses', compact('verses_edit_obj'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update verses!');
        }
        $request->validate([
            'category_id' => 'required|max:255',
            'title' => 'required|max:255',
            'title_in_english' => 'required|max:255',
            'content' => 'required',
            'rag' => 'max:255',
            'tal' => 'max:255',
            'composer_id' => 'integer',
            'composition_place' => 'max:255',
            'notation' => 'max:255',
            'posts_notation_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'posts_youtube_video_url' => 'nullable|url'
        ]);
        try {
            $this->versesObj->update($request->all(), $id);
            return redirect(route('verses.index'))->with('tatus', 'Verses updated successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete verses!');
        }
        try {
            $this->versesObj->delete($id);
            return redirect(route('verses.index'))->with('status', 'Verses deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function allVerses(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access verses default list page!');
        }
        if ($request->ajax()) {
            $data = $this->versesObj->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-info text-white" href=' . route("verses.edit", $row['id']) . '>Edit</a>';
                    $token = csrf_token();
                    $btn .= '<a class="btn btn-danger text-white" href=' . route("verses.destroy", $row['id']) . ' onclick="javascript:delete_form_processing(' . $row['id'] . ');">Delete</a>
                    <form id="delete-form-' . $row['id'] . '" action=' . route('verses.destroy', $row['id']) . ' method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . $token . '"></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
