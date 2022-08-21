<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsModel extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'created_by_user_id', // master book table id
        'category_id',
        'root_category_id',
        'artists_id',
        'content', // in sec
        'title',
        'title_in_english'
    ];

    public function posts_details()
    {
        return $this->hasOne(PostsDetailsModel::class, 'post_id');
    }
    public function posts_media()
    {
        return $this->hasOne(PostsMediaModel::class, 'post_id', 'id');
    }
}
