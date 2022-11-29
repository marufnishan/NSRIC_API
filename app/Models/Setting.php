<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'email',
        'alternate_email',
        'phone',
        'alternate_phone',
        'location',
        'about_us',
        'fb_link',
        'twitter_link',
        'youtube_link',
        'linkedin_link',
        'insta_link',
        'telegram_link',
    ];

    public function metafild()
    {
        return $this->hasMany(SettingMeta::class,'meta_id');
    }
}
