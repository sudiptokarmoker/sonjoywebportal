<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistsContactDetailsModel extends Model
{
    use HasFactory;
    protected $table = 'artists_contact_details';
    protected $fillable = [
        'artists_id',
        'email',
        'mobile',
        'address_line_one',
        'address_line_two',
        'city',
        'state',
        'country',
    ];
}
