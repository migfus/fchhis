<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FAQ extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'answer_user_id',
        'approved_user_id',
        'question',
        'answer',
        'points'
    ];
}
