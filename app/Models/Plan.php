<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Plan extends Model
{
    use HasFactory, HasShortflakePrimary;

    protected $fillabe = [
        'user_id',
        'avatar',
        'name'
    ];

    public function plan_detail() {
        return $this->hasMany(PlanDetail::class, 'plan_id');
    }
}
