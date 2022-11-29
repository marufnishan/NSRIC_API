<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisionUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'devision_id',
        'title',
        'is_active',
    ];

    public function metafild()
    {
        return $this->hasMany(DevisionUnitMeta::class,'meta_id');
    }
}
