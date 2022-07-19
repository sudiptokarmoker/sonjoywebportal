<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComposerModel extends Model
{
    use HasFactory;
    protected $table = 'composer';
    protected $fillable = [
        'name',
        'name_in_bangla',
    ];
    public function composerContactDetails()
    {
        return $this->hasOne(ComposerContactDetailsModel::class, 'composer_id', 'id');
    }
    public function composerPersonalDetils()
    {
        return $this->hasOne(ComposerPersonalDetailsModel::class, 'composer_id', 'id');
    }
}
