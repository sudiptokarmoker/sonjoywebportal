<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\VersesCategoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class VersesCategoryController extends Controller
{
    protected $versesCategoryObj;
    public function __construct(VersesCategoryRepositoryInterface $versesCategoryObjInterface)
    {
        $this->versesCategoryObj = $versesCategoryObjInterface;
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses_category.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access verses category default list page!');
        }
        return view('backend.pages.verses_category.index_verses_category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses_category.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to create verses category default list page!');
        }
        return view('backend.pages.verses_category.create_verses_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses_category.save')) {
            abort(403, 'Sorry !! You are unauthorized to create verses category!');
        }
        $request->validate([
            'category_name' => 'required|max:255',
            'category_name_bangla' => 'required|max:255',
        ]);
        try {
            $this->versesCategoryObj->save($request->all());
            return redirect(route('verses_category.index'))->with('status', 'Verses category created successfully!');
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
            abort(403, 'Sorry !! You are Unauthorized to access verses category edit form page!');
        }
        $verses_category = $this->versesCategoryObj->edit($id);
        return view('backend.pages.verses_category.edit_verses_category', compact('verses_category'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses_category.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update verses category!');
        }
        $request->validate([
            'category_name' => 'required|max:255',
            'category_name_bangla' => 'required|max:255',
        ]);
        try {
            $this->versesCategoryObj->update($request->all(), $id);
            return redirect(route('songs_category.index'))->with('status', 'Verses category updated successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses_category.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete category!');
        }
        try {
            $delete = $this->versesCategoryObj->delete($id);
            return redirect(route('verses_category.index'))->with('status', 'Verses category deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function allVersesCatetoryLists(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('verses_category.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access verses category default list page!');
        }
        if ($request->ajax()) {
            $data = $this->versesCategoryObj->all();
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
                    $btn = '<a class="btn btn-info text-white" href=' . route("verses_category.edit", $category['id']) . '>Edit</a>';
                    $token = csrf_token();
                    $btn .= '<a class="btn btn-danger text-white" href=' . route("verses_category.destroy", $category['id']) . ' onclick="javascript:delete_form_processing(' . $category['id'] . ');">Delete</a>
                    <form id="delete-form-' . $category['id'] . '" action=' . route('verses_category.destroy', $category['id']) . ' method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . $token . '"></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
