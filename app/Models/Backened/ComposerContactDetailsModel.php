<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComposerContactDetailsModel extends Model
{
    use HasFactory;
    protected $table = 'composer_contact_details';
    protected $fillable = [
        'composer_id',
        'email',
        'mobile',
        'address_line_one',
        'address_line_two',
        'city',
        'state',
        'country',
    ];
}
