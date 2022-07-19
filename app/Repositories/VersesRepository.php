<?php
namespace App\Repositories;

use App\Models\Backened\ArtistsModel;
use App\Models\Backened\ComposerModel;
use App\Models\Backened\PostsCategoryModel;
use App\Models\Backened\PostsDetailsModel;
use App\Models\Backened\PostsMediaModel;
use App\Models\Backened\PostsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VersesRepository implements VersesRepositoryInterface
{
    private $verses_category_id = 1;
    public function all()
    {
        return PostsModel::where('root_category_id', '=', $this->verses_category_id)
            ->orderBy("id", "asc")
            ->get()
            ->map(function ($row) {
                return [
                    'id' => $row->id,
                    'title' => $row->title,
                    'title_in_english' => $row->title_in_english,
                ];
            });
    }
    public function getVersesCategoryId()
    {
        $getVersesCategorryId = PostsCategoryModel::where('category_name', 'verses')->first();
        return $getVersesCategorryId ? $getVersesCategorryId->id : null;
    }
    public function getAllVersesCategoryLists()
    {
        $getVersesCategorryId = PostsCategoryModel::where('category_name', 'verses')->first();
        $collection = PostsCategoryModel::where('parent_id', $getVersesCategorryId->id)->get();
        return $collection->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'category_name' => $item->category_name,
                'category_name_bangla' => $item->category_name_bangla,
                'created_at' => $item->created_at->format('m/d/Y'),
            ];
        });
    }
    public function save(array $data)
    {
        $categoryIdDataArray = [];
        $artistsDatIdArray = [];
        if (count($data['category_id']) > 0) {
            foreach ($data['category_id'] as $category_item) {
                if ($category_item && $category_item > 0) {
                    $categoryIdDataArray[] = intval($category_item);
                }
            }
        }
        if (isset($data['artists_lists']) && count($data['artists_lists']) > 0) {
            foreach ($data['artists_lists'] as $artists_id) {
                if ($artists_id && $artists_id > 0) {
                    $artistsDatIdArray[] = intval($artists_id);
                }
            }
        }
        if (count($artistsDatIdArray) == 0) {
            $artistsDatIdArray = null;
        }
        /**
         * upload notation images
         */
        /**
         * Upload new file
         */
        $filesInfo = null;
        if (isset($data['posts_notation_images'])) {
            $input_file = $data['posts_notation_images']->getClientOriginalName();
            $original_file_name_withtout_extension = pathinfo($input_file, PATHINFO_FILENAME);
            $filesInfo = seoUrl($original_file_name_withtout_extension) . '-' . set_unique_image_file_name_on_save(\Illuminate\Support\Str::uuid(), $data['posts_notation_images']->extension());
            $data['posts_notation_images']->storeAs('images/notation', $filesInfo, 'public');
        }
        // end of upload notation image
        $postsInsertModelObj = PostsModel::create([
            'created_by_user_id' => Auth::id(),
            'category_id' => json_encode($categoryIdDataArray),
            'root_category_id' => $data['root_category_id'],
            'artists_id' => json_encode($artistsDatIdArray),
            'title' => $data['title'],
            'title_in_english' => $data['title_in_english'],
            'content' => $data['content'],
        ]);
        // insert into posts details
        if ($postsInsertModelObj && $postsInsertModelObj->id) {
            PostsDetailsModel::create([
                'post_id' => $postsInsertModelObj->id,
                'composer_id' => $data['composer_id'],
                'rag' => $data['rag'],
                'tal' => $data['tal'],
                'composition_time_bangla' => $data['composition_time_bangla'],
                'composition_time_english' => $data['composition_time_english'],
                'composition_place' => $data['composition_place'],
                'notation' => $data['notation'],
            ]);
        }
        // for notation image + youtub video
        PostsMediaModel::create([
            'post_id' => $postsInsertModelObj->id,
            'posts_notation_images' => $filesInfo,
            'posts_youtube_video_url' => $data['posts_youtube_video_url'],
        ]);

        return $postsInsertModelObj;
    }
    public function getArtistsListsData()
    {
        $collection = ArtistsModel::all();
        return $collection->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'name_in_bangla' => $item->name_in_bangla,
            ];
        });
    }
    public function getComposerListsData()
    {
        $collection = ComposerModel::all();
        return $collection->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'name_in_bangla' => $item->name_in_bangla,
            ];
        });
    }
    public function edit($id)
    {
        $item = PostsModel::findOrFail($id);
        return [
            'id' => $item->id,
            'created_by_user_id' => $item->created_by_user_id,
            'category_id' => json_decode($item->category_id),
            'root_category_id' => $item->root_category_id,
            'artists_id' => json_decode($item->artists_id),
            'title' => $item->title,
            'title_in_english' => $item->title_in_english,
            'content' => $item->content,
            'posts_details' => $item->posts_details,
            'posts_media' => $item->posts_media,
            'category_lists' => $this->getAllVersesCategoryLists(),
            'artists_lists' => $this->getArtistsListsData(),
            'composer_lists' => $this->getComposerListsData(),
        ];
        /*
    $category_lists = $this->songsObj->getAllSongsCategoryLists();
    $songsRootCategoryId = $this->songsObj->getSongsCategoryId();
    $artists_lists = $this->songsObj->getArtistsListsData();
    $composer_lists = $this->songsObj->getComposerListsData();
     */
    }
    public function update(array $data, $id)
    {
        $postsModelObj = PostsModel::findOrFail($id);

        $categoryIdDataArray = [];
        $artistsDatIdArray = [];
        if (count($data['category_id']) > 0) {
            foreach ($data['category_id'] as $category_item) {
                if ($category_item && $category_item > 0) {
                    $categoryIdDataArray[] = intval($category_item);
                }
            }
        }
        if (isset($data['artists_lists']) && count($data['artists_lists']) > 0) {
            foreach ($data['artists_lists'] as $artists_id) {
                if ($artists_id && $artists_id > 0) {
                    $artistsDatIdArray[] = intval($artists_id);
                }
            }
        }
        if (count($artistsDatIdArray) == 0) {
            $artistsDatIdArray = null;
        }
        /**
         * edit notation images
         */
        $filesInfo = $postsModelObj->posts_media && $postsModelObj->posts_media->posts_notation_images ? $postsModelObj->posts_media->posts_notation_images : null;
        if (isset($data['posts_notation_images'])) {
            if (Storage::disk('public')->exists('images/notation/' . $postsModelObj->posts_media->posts_notation_images)) {
                Storage::disk('public')->delete('images/notation/' . $postsModelObj->posts_media->posts_notation_images);
            }

            $input_file = $data['posts_notation_images']->getClientOriginalName();
            $original_file_name_withtout_extension = pathinfo($input_file, PATHINFO_FILENAME);
            $filesInfo = seoUrl($original_file_name_withtout_extension) . '-' . set_unique_image_file_name_on_save(\Illuminate\Support\Str::uuid(), $data['posts_notation_images']->extension());
            $data['posts_notation_images']->storeAs('images/notation', $filesInfo, 'public');
        }
        /**
         * Upload new file
         */
        PostsModel::where('id', $id)
            ->update([
                'category_id' => json_encode($categoryIdDataArray),
                'artists_id' => json_encode($artistsDatIdArray),
                'title' => $data['title'],
                'title_in_english' => $data['title_in_english'],
                'content' => $data['content'],
            ]);
        PostsDetailsModel::where('post_id', $id)
            ->update([
                'composer_id' => $data['composer_id'],
                'rag' => $data['rag'],
                'tal' => $data['tal'],
                'composition_time_bangla' => $data['composition_time_bangla'],
                'composition_time_english' => $data['composition_time_english'],
                'composition_place' => $data['composition_place'],
                'notation' => $data['notation'],
            ]);
        // for notation image + youtub video
        PostsMediaModel::where('post_id', $id)
            ->update([
                'posts_notation_images' => $filesInfo,
                'posts_youtube_video_url' => $data['posts_youtube_video_url'],
            ]);
        return;
    }
    // delete
    public function delete($id){
        $postsModelObj = PostsModel::findOrFail($id);
        // delete the notation images here
        if ($postsModelObj->posts_media && $postsModelObj->posts_media->posts_notation_images) {
            if (Storage::disk('public')->exists('images/notation/' . $postsModelObj->posts_media->posts_notation_images)) {
                Storage::disk('public')->delete('images/notation/' . $postsModelObj->posts_media->posts_notation_images);
            }
        }
        $postsModelObj->delete();
        return;
    }
}
