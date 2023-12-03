<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom_tag_photo extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'photo_id',
        'custom_tag_id',
    ];
}