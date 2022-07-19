<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'posts_category';
    protected $fillable = [
        'category_name',
        'category_name_bangla',
        'category_slug',
        'category_slug_bangla',
        'created_by_user_id',
        'parent_id'
    ];
    public function setCategorySlugAttribute($category_name)
    {
        $this->attributes['category_slug'] = $this->preparing_category_slug($category_name);
    }
    public function setCategorySlugBanglaAttribute($category_name_bangla)
    {
        $this->attributes['category_slug_bangla'] = $this->preparing_category_slug_bangla($category_name_bangla);
    }
    public function preparing_category_slug($category_name)
    {
        if (strlen($category_name) > 0) {
            $filterText = preg_replace('/[^a-zA-Z0-9_ -]/s', ' ', $category_name);
            $slug = str_replace(' ', '-', strtolower($filterText));
            $count = PostsCategoryModel::where('category_slug', 'LIKE', $slug . '%')->count();
            $suffex = $count ? $count + 1 : '';
            $slug .= $suffex;
            return $slug;
        } else {
            return null;
        }
    }
    public function preparing_category_slug_bangla($category_name_bangla)
    {
        if (strlen($category_name_bangla) > 0) {
            //$filterText = preg_replace('/[^a-zA-Z0-9_ -]/s', ' ', $category_name_bangla);
            //$slug = str_replace(' ', '-', strtolower($filterText));
            $slug = str_replace(' ', '-', $category_name_bangla);
            $count = PostsCategoryModel::where('category_slug_bangla', 'LIKE', $slug . '%')->count();
            $suffex = $count ? $count + 1 : '';
            $slug .= $suffex;
            return $slug;
        } else {
            return null;
        }
    }
}
