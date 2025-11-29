<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artical extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'title',
        'content',
        // 'user_id',
        'image_path',
        'slug',
    ];
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
