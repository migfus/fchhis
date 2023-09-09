<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class EventCategory extends Model
{
    use HasFactory, HasShortflakePrimary;

    protected $fillable = [
        'user_id',
        'name',
        'bg_color',
        'text_color',
    ];
}
