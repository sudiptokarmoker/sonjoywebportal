<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\NovelsRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class NovelsController extends Controller
{
    protected $novelsObj;
    public function __construct(NovelsRepositoryInterface $novelsObjInterface)
    {
        $this->novelsObj = $novelsObjInterface;
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('novels.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access novels default list page!');
        }
        return view('backend.pages.novels.index_novels');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $novelsRootCategoryId = $this->novelsObj->getNovelsCategoryId();
        if (is_null($this->user) || !$this->user->hasPermissionTo('novels.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to create novels create page!');
        }
        return view('backend.pages.novels.create_novels', compact('novelsRootCategoryId'));
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
            'root_category_id' => 'required|integer',
            'title' => 'required|max:255',
            'title_in_english' => 'required|max:255',
            //'content' => 'required',
            'posts_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'posts_file' => 'mimes:pdf'
        ]);
        try {
            //dd($request->all());
            $postInsert = $this->novelsObj->save($request->all());
            return redirect(route('novels.index'))->with('status', 'Novels Category Successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('novels.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to access novels edit form page!');
        }
        $novels_edit_obj = $this->novelsObj->edit($id);
        //dd($songs_edit_obj);
        if (is_null($this->user) || !$this->user->hasPermissionTo('novels.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view edit novels page!');
        }
        return view('backend.pages.novels.edit_novels', compact('novels_edit_obj'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('novels.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update novels!');
        }
        $request->validate([
            'title' => 'required|max:255',
            'title_in_english' => 'required|max:255',
            'posts_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'posts_file' => 'mimes:pdf'
        ]);
        try {
            $this->novelsObj->update($request->all(), $id);
            return redirect(route('novels.index'))->with('tatus', 'Novels updated successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('novels.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete novels!');
        }
        try {
            $this->novelsObj->delete($id);
            return redirect(route('novels.index'))->with('status', 'Novels deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function allNovels(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('novels.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access novels default list page!');
        }
        if ($request->ajax()) {
            $data = $this->novelsObj->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-info text-white" href=' . route("novels.edit", $row['id']) . '>Edit</a>';
                    $token = csrf_token();
                    $btn .= '<a class="btn btn-danger text-white" href=' . route("novels.destroy", $row['id']) . ' onclick="javascript:delete_form_processing(' . $row['id'] . ');">Delete</a>
                    <form id="delete-form-' . $row['id'] . '" action=' . route('novels.destroy', $row['id']) . ' method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . $token . '"></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
