<?php
namespace App\Repositories;

use App\Models\Backened\PostsCategoryAllGeneralModel;
use Illuminate\Support\Facades\Auth;

class PostsCategoryAllGeneralRepository implements PostsCategoryAllGeneralRepositoryInterface
{
    public function all()
    {
        return PostsCategoryAllGeneralModel::where('parent_id', '=', 0)->
            orderBy("id", "asc")
            ->get()
            ->map(function ($row) {
                return [
                    'id' => $row->id,
                    'category_name' => $row->category_name,
                    'category_name_bangla' => $row->category_name_bangla,
                    'category_slug' => $row->category_slug,
                    'category_slug_bangla' => $row->category_slug_bangla,
                    'created_by_user_id' => $row->created_by_user_id,
                    'created_at' => $row->created_at,
                ];
            });
    }
    public function save(array $data)
    {
        /**
         * save data
         */
        PostsCategoryAllGeneralModel::create([
            'category_name' => $data['category_name'],
            'category_name_bangla' => $data['category_name_bangla'],
            'category_slug' => $data['category_name'],
            'category_slug_bangla' => $data['category_name_bangla'],
            'created_by_user_id' => Auth::id(),
        ]);
        return;
    }
    // edit
    public function edit($id)
    {
        $item = PostsCategoryAllGeneralModel::findOrFail($id);
        return [
            'id' => $item->id,
            'category_name' => $item->category_name,
            'category_name_bangla' => $item->category_name_bangla,
            'category_slug' => $item->category_slug,
            'category_slug_bangla' => $item->category_slug_bangla,
        ];
    }
    // edit
    public function update(array $data, $id)
    {
        $postsCatetoryEditObj = PostsCategoryAllGeneralModel::findOrFail($id);
        $postsCatetoryEditObj->category_name = $data['category_name'];
        $postsCatetoryEditObj->category_name_bangla = $data['category_name_bangla'];
        $postsCatetoryEditObj->update();
        return $postsCatetoryEditObj;
    }
    // delete
    public function delete($id){
        $postsCatetoryEditObj = PostsCategoryAllGeneralModel::findOrFail($id);
        $postsCatetoryEditObj->delete();
        return;
    }
    /**
     * Return category
     */
    public function getALLCategoryForParenSelection(){
        
    }
}
