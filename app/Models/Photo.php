<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tag_id',
        'custom_tag',
        'latitude',
        'longitude',
        'photo_pas',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    
}
