<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsMediaModel extends Model
{
    use HasFactory;
    protected $table = 'posts_media';
    protected $fillable = [
        'post_id', // master book table id
        'posts_image',
        'posts_youtube_video_url',
        'posts_notation_images'
    ];
}
