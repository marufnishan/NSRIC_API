<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_id',
        'meta_key',
        'meta_value',
    ];
}
