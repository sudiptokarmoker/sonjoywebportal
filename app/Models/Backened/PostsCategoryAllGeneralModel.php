<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsCategoryAllGeneralModel extends Model
{
    use HasFactory;
    protected $table = 'posts_category';
    protected $fillable = [
        'category_name',
        'category_name_bangla',
        'category_slug',
        'category_slug_bangla',
        'created_by_user_id',
    ];
}
