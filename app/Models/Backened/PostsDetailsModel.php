<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsDetailsModel extends Model
{
    use HasFactory;
    protected $table = 'posts_details';
    protected $fillable = [
        'post_id', // master book table id
        'rag',
        'tal',
        'composer_id',
        'composition_time_bangla',
        'composition_time_english', // in sec
        'composition_place',
        'notation'
    ];
}
