<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssaysModel extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'created_by_user_id', // master book table id
        'category_id',
        'content', // in sec
        'title',
    ];
}
