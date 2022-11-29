<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'long_title',
        'short_title',
        'link',
        'is_active',
    ];

    public function metafild()
    {
        return $this->hasMany(SliderMeta::class,'meta_id');
    }
}
