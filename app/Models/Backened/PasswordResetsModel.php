<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetsModel extends Model
{
    use HasFactory;
    protected $table = 'password_resets';
    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];
    public $timestamps = false;
}
