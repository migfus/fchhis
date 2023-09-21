<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Post extends Model
{
    use HasFactory, HasShortflakePrimary;

    protected $fillable = [
        'post_category_id',
        'title' ,
        'content',
        'cover',
    ];

    public function category() {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
