<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsContentDetails extends Model
{
    use HasFactory;
    protected $table = 'posts_content_details';
    protected $fillable = [
        'post_id', // master book table id
        'page_content'
    ];
}
