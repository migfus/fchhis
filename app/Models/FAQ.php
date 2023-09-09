<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class FAQ extends Model
{
    use HasFactory, HasShortflakePrimary;

    protected $fillable = [
        'answer_user_id',
        'approved_user_id',
        'question',
        'answer',
        'points'
    ];
}
