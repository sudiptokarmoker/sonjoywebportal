<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistsModel extends Model
{
    use HasFactory;
    protected $table = 'artists';
    protected $fillable = [
        'name',
        'name_in_bangla',
    ];
    public function artistsContactDetails()
    {
        return $this->hasOne(ArtistsContactDetailsModel::class, 'artists_id', 'id');
    }
    public function artistsPersonalDetils()
    {
        return $this->hasOne(ArtistsPersonalDetailsModel::class, 'artists_id', 'id');
    }
}
