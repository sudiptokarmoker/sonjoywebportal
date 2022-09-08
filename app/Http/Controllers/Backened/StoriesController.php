<?php

namespace App\Http\Controllers\Backened;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\StoriesRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class StoriesController extends Controller
{
    protected $storiesObj;
    public function __construct(StoriesRepositoryInterface $storiesObjInterface)
    {
        $this->storiesObj = $storiesObjInterface;
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });Dhaka, 2022-07-22

Dear Sir,

I’m excited to apply for the Senior Software Engineer PHPLaravelposition at Axilweb. I
am working more than 10 Years+ in the web technology, and I am passionate about doing a great
job and out of the skills you’re looking for.


I’m very interested in beginning a career in the Axilwebcareer field, and I something motivates
to Join In. I believe I’ll make an excellent in this position - Senior Software Engineer PHPLaravel. Here are the following accomplishments of my work:

https://vioresume.com(laravel, angular)
https://visionboarder.com(yii, nodejs, javascript)
http://www.customrecall.com(magento 1.9)
https://www.upack.in(magento 1.9)
https://dynamicgroup-bd.com (php)

Thank You Sir
Best Regards
Sudipto Karmoker
Full Stack Developer

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('stories.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access stories default list page!');
        }
        return view('backend.pages.stories.index_stories');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_lists = $this->storiesObj->getAllStoriesCategoryLists();
        $storiesRootCategoryId = $this->storiesObj->getStoriesCategoryId();
        $artists_lists = $this->storiesObj->getArtistsListsData();
        $composer_lists = $this->storiesObj->getComposerListsData();
        if (is_null($this->user) || !$this->user->hasPermissionTo('stories.create.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to create stories create page!');
        }
        return view('backend.pages.stories.create_stories', compact('storiesRootCategoryId', 'category_lists', 'artists_lists', 'composer_lists'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('stories.save')) {
            abort(403, 'Sorry !! You are unauthorized to store stories!');
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
            $this->storiesObj->save($request->all());
            return redirect(route('verses.index'))->with('status', 'Stories saved successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('stories.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to access stories edit form page!');
        }
        $stories_edit_obj = $this->storiesObj->edit($id);
        //dd($songs_edit_obj);
        if (is_null($this->user) || !$this->user->hasPermissionTo('stories.edit.form.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view edit stories page!');
        }
        return view('backend.pages.stories.edit_stories', compact('stories_edit_obj'));
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('stories.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update stories!');
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
            $this->storiesObj->update($request->all(), $id);
            return redirect(route('stories.index'))->with('tatus', 'Stores updated successfully!');
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
        if (is_null($this->user) || !$this->user->hasPermissionTo('stories.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete stories!');
        }
        try {
            $this->storiesObj->delete($id);
            return redirect(route('verses.index'))->with('status', 'Stories deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function allStories(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasPermissionTo('stories.list')) {
            abort(403, 'Sorry !! You are Unauthorized to access stories default list page!');
        }
        if ($request->ajax()) {
            $data = $this->storiesObj->all();
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
