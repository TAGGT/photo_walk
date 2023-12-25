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
        'latitude',
        'longitude',
        'photo_pas',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function custom_tags()
    {
        return $this->belongsToMany(Custom_tag::class, 'custom_tag_photos');
    }
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
}
