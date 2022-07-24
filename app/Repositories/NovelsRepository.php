<?php
namespace App\Repositories;
use App\Models\Backened\PostsDetailsModel;
use App\Models\Backened\PostsMediaModel;
use App\Models\Backened\PostsCategoryModel;
use App\Models\Backened\PostsContentDetails;
use App\Models\Backened\PostsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ForceUTF8\Encoding;

class NovelsRepository implements NovelsRepositoryInterface
{
    private $novels_category_id = 3;
    public function all()
    {
        return PostsModel::where('root_category_id', '=', $this->novels_category_id)
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
    public function getNovelsCategoryId()
    {
        $getNovelsCategorryId = PostsCategoryModel::where('category_name', 'novels')->first();
        return $getNovelsCategorryId ? $getNovelsCategorryId->id : null;
    }
    public function save(array $data)
    {
        /**
         * Upload new file
         */
        $postsImageFilesInfo = null;
        $postsFileInfo = null;
        if (isset($data['posts_image'])) {
            $input_file = $data['posts_image']->getClientOriginalName();
            $original_file_name_withtout_extension = pathinfo($input_file, PATHINFO_FILENAME);
            $postsImageFilesInfo = seoUrl($original_file_name_withtout_extension) . '-' . set_unique_image_file_name_on_save(\Illuminate\Support\Str::uuid(), $data['posts_image']->extension());
            $data['posts_image']->storeAs('images/posts_image', $postsImageFilesInfo, 'public');
        }
        // end of upload notation image
        // upload content files start
        if (isset($data['posts_file'])) {
            $file = $data['posts_file']->getClientOriginalName();
            $original_file_name_withtout_extension = pathinfo($file, PATHINFO_FILENAME);
            $postsFileInfo = seoUrl($original_file_name_withtout_extension) . '-' . set_unique_image_file_name_on_save(\Illuminate\Support\Str::uuid(), $data['posts_file']->extension());
            $data['posts_file']->storeAs('novels', $postsFileInfo, 'public');
            // now get content of files
            //$contents = Storage::get('public/novels/'.$uploadFile);
        }
        // end of upload documents
        $postsInsertModelObj = PostsModel::create([
            'created_by_user_id' => Auth::id(),
            'root_category_id' => $data['root_category_id'],
            'title' => $data['title'],
            'title_in_english' => $data['title_in_english'],
            'title_in_english' => $data['title_in_english'],
            'content' => $data['content']
        ]);
        // here content will be pushed
        /*
        $paginationConent = SplitStringToParts($data['content'], 1500);
        if($paginationConent && count($paginationConent) > 0){
            foreach($paginationConent as $pageData){
                PostsContentDetails::create([
                    'post_id' => $postsInsertModelObj->id,
                    'page_content' => $pageData
                ]);
            }
        }
        */
        // for notation image + youtub video
        PostsMediaModel::create([
            'post_id' => $postsInsertModelObj->id,
            'posts_image' => $postsImageFilesInfo,
            'posts_file' => $postsFileInfo
        ]);
        return $postsInsertModelObj;
    }

    public function edit($id)
    {
        $item = PostsModel::findOrFail($id);
        return [
            'id' => $item->id,
            'created_by_user_id' => $item->created_by_user_id,
            'category_id' => json_decode($item->category_id),
            'root_category_id' => $item->root_category_id,
            'title' => $item->title,
            'title_in_english' => $item->title_in_english,
            'content' => $item->content,
            'posts_media' => $item->posts_media
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
        /**
         * edit notation images
         */

        $postsImageFilesInfo = $postsModelObj->posts_media && $postsModelObj->posts_media->posts_images ? $postsModelObj->posts_media->posts_images : null;;
        $postsFileInfo = $postsModelObj->posts_media && $postsModelObj->posts_media->posts_file ? $postsModelObj->posts_media->posts_file : null;;

        if (isset($data['posts_images'])) {
            if (Storage::disk('public')->exists('images/posts_images/' . $postsModelObj->posts_media->posts_images)) {
                Storage::disk('public')->delete('images/posts_images/' . $postsModelObj->posts_media->posts_images);
            }
            $input_file = $data['posts_images']->getClientOriginalName();
            $original_file_name_withtout_extension = pathinfo($input_file, PATHINFO_FILENAME);
            $postsImageFilesInfo = seoUrl($original_file_name_withtout_extension) . '-' . set_unique_image_file_name_on_save(\Illuminate\Support\Str::uuid(), $data['posts_images']->extension());
            $data['posts_images']->storeAs('images/posts_images', $postsImageFilesInfo, 'public');
            // update db
            PostsMediaModel::where('post_id', $id)
            ->update([
                'posts_images' => $postsImageFilesInfo,
            ]);
        }
       // for posts file
       if (isset($data['posts_file'])) {
            if (Storage::disk('public')->exists('novels/' . $postsModelObj->posts_media->posts_file)) {
                Storage::disk('public')->delete('novels/' . $postsModelObj->posts_media->posts_file);
            }
            $input_file = $data['posts_file']->getClientOriginalName();
            $original_file_name_withtout_extension = pathinfo($input_file, PATHINFO_FILENAME);
            $postsFileInfo = seoUrl($original_file_name_withtout_extension) . '-' . set_unique_image_file_name_on_save(\Illuminate\Support\Str::uuid(), $data['posts_file']->extension());
            $data['posts_file']->storeAs('novels', $postsFileInfo, 'public');
            // update db
            PostsMediaModel::where('post_id', $id)
            ->update([
                'posts_file' => $postsFileInfo,
            ]);
        }

        PostsModel::where('id', $id)
            ->update([
                'title' => $data['title'],
                'title_in_english' => $data['title_in_english'],
                'content' => $data['content'],
            ]);
        return;
    }
    // delete
    public function delete($id){
        $postsModelObj = PostsModel::findOrFail($id);
        // delete the notation images here
        if ($postsModelObj->posts_media && $postsModelObj->posts_media->posts_images) {
            if (Storage::disk('public')->exists('images/posts_images/' . $postsModelObj->posts_media->posts_images)) {
                Storage::disk('public')->delete('images/posts_images/' . $postsModelObj->posts_media->posts_images);
            }
        }
        if ($postsModelObj->posts_media && $postsModelObj->posts_media->posts_file) {
            if (Storage::disk('public')->exists('novels/' . $postsModelObj->posts_media->posts_file)) {
                Storage::disk('public')->delete('novels/' . $postsModelObj->posts_media->posts_file);
            }
        }

        $postsModelObj->delete();
        return;
    }
}
