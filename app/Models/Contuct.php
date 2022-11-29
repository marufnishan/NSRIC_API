<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contuct extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];

    public function metafild()
    {
        return $this->hasMany(ContuctMeta::class,'meta_id');
    }
}
