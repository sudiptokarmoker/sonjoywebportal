<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistsPersonalDetailsModel extends Model
{
    use HasFactory;
    protected $table = 'artists_personal_details';
    protected $fillable = [
        'artists_id',
        'gender',
        'date_of_birth'
    ];
}
