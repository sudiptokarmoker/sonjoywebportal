<?php

namespace App\Models\Backened;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettingsModel extends Model
{
    use HasFactory;
    protected $table = 'site_settings';
    protected $fillable = [
        'module_identifier',
        'param',
        'param_value'
    ];
}
