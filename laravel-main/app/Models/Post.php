<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\GuardsAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $gaurded = [];
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'excerpt',
    ];

    // public function posts()
    // {
    //     return $this->hasMany(Post::class);
    // }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}

