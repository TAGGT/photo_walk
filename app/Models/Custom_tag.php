<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom_tag extends Model
{
    use HasFactory;

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'custom_tag_photos');
    }
}
