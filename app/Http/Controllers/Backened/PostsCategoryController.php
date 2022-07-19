<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use App\Repositories\PostsCategoryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class PostsCategoryController extends Controller
{
    protected $postsCourseCatetoryObj;
    public function __construct(PostsCategoryRepositoryInterface $postsCourseCatetoryRepoInteface)
    {
        $this->postsCourseCatetoryObj = $postsCourseCatetoryRepoInteface;
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('posts_category.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access category default list page!');
        }
        return view('backend.pages.posts_category.index_posts_category');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('posts_category.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to create category default list page!');
        }
        return view('backend.pages.posts_category.create_posts_category');
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
            $this->postsCourseCatetoryObj->save($request->all());
            return redirect(route('posts_category.index'))->with('status', 'Category created successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('posts_category.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to access category edit form page!');
        }
        $posts_category = $this->postsCourseCatetoryObj->edit($id);
        return view('backend.pages.posts_category.edit_posts_category', compact('posts_category'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('posts_category.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update category!');
        }
        $request->validate([
            'category_name' => 'required|max:255',
            'category_name_bangla' => 'required|max:255',
        ]);
        try {
            $this->postsCourseCatetoryObj->update($request->all(), $id);
            return redirect(route('posts_category.index'))->with('status', 'Category updated successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('posts_category.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete category!');
        }
        try {
            $delete = $this->postsCourseCatetoryObj->delete($id);
            return redirect(route('posts_category.index'))->with('status', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function allCatetoryLists(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('users.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access users default list page!');
        }
        if ($request->ajax()) {
            $data = $this->postsCourseCatetoryObj->all();
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
                    $btn = '<a class="btn btn-info text-white" href=' . route("posts_category.edit", $category['id']) . '>Edit</a>';
                    $token = csrf_token();
                    $btn .= '<a class="btn btn-danger text-white" href=' . route("posts_category.destroy", $category['id']) . ' onclick="javascript:delete_form_processing(' . $category['id'] . ');">Delete</a>
                    <form id="delete-form-' . $category['id'] . '" action=' . route('posts_category.destroy', $category['id']) . ' method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . $token . '"></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
