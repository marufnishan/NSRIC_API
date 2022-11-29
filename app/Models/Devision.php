<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devision extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'is_active',
    ];

    public function metafild()
    {
        return $this->hasMany(DevisionMeta::class,'meta_id');
    }
}
