<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComposerPersonalDetailsModel extends Model
{
    use HasFactory;
    protected $table = 'composer_personal_details';
    protected $fillable = [
        'composer_id',
        'gender',
        'date_of_birth'
    ];
}
