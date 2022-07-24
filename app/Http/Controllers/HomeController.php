<?php

namespace App\Http\Controllers;

use App\Models\Backened\ArtistsModel;
use App\Models\Backened\PostsCategoryModel;
use App\Models\Backened\PostsModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $categories;
    private $artists;
    private $artist;
    private $posts;
    //private $categories;
    private $categoryName;

    public function index()
    {
        $this->artists = ArtistsModel::all();
        $this->categories = PostsCategoryModel::all();
        $this->posts = PostsModel::all();
        return view('frontend.pages.home',['posts' => $this->posts,
            'artists'=> $this->artists,
            'categories' =>$this->categories]);
    }

    public function artist()
    {
        $this->artists = ArtistsModel::all();
        $this->posts = PostsModel::all();

        return view('frontend.pages.artist',['artists' => $this->artists]);
    }

    public function artistDetail($id)
    {
        $this->artist = ArtistsModel::where('id', $id)->get();
        //return $this->artist;
        $this->posts = PostsModel::where('artists_id', $id)->get()->take(1);
        return view('frontend.pages.artistDetail',['posts' => $this->posts,
            'artist'=> $this->artist]);
    }

    public function artistList($id,$name)
    {
        $this->posts = PostsModel::where('id', $id)->get();
        return view('frontend.pages.artistList',['posts' => $this->posts, 'name' => $name]);
    }
}
