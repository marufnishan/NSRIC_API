<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_id',
        'meta_key',
        'meta_value',
    ];
}
