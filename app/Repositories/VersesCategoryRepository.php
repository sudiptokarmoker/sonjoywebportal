<?php
namespace App\Repositories;
use App\Models\Backened\PostsCategoryModel;
use Illuminate\Support\Facades\Auth;

class VersesCategoryRepository implements VersesCategoryRepositoryInterface
{
    // here this is going to target song category. 
    // primarily it would work. but later if need to customize this then have to modify this.
    // verses category == 1
    private $verses_category_id = 1;
    public function all()
    {
        return PostsCategoryModel::where('parent_id', '=', $this->verses_category_id)->
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
        PostsCategoryModel::create([
            'category_name' => $data['category_name'],
            'category_name_bangla' => $data['category_name_bangla'],
            'category_slug' => $data['category_name'],
            'category_slug_bangla' => $data['category_name_bangla'],
            'created_by_user_id' => Auth::id(),
            'parent_id' => $this->verses_category_id
        ]);
        return;
    }
    // edit
    public function edit($id)
    {
        $item = PostsCategoryModel::findOrFail($id);
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
        $postsCatetoryEditObj = PostsCategoryModel::findOrFail($id);
        $postsCatetoryEditObj->category_name = $data['category_name'];
        $postsCatetoryEditObj->category_name_bangla = $data['category_name_bangla'];
        //$postsCatetoryEditObj->category_slug = $data['category_name'];
        //$postsCatetoryEditObj->category_slug_bangla = $data['category_name_bangla'];
        $postsCatetoryEditObj->update();
        return $postsCatetoryEditObj;
    }
    // delete
    public function delete($id){
        $postsCatetoryEditObj = PostsCategoryModel::findOrFail($id);
        $postsCatetoryEditObj->delete();
        return;
    }
}
