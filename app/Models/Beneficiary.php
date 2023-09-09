<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Beneficiary extends Model
{
    use HasFactory, HasShortflakePrimary;

    protected $fillable = [
        'user_id',
        'staff_id',
        'name',
        'bday'
    ];
}
