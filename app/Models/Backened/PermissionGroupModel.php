<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionGroupModel extends Model
{
    use HasFactory;
    protected $table = 'permissions_group';
    protected $fillable = [
        'group_name'
    ];
}
