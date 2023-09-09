<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Transaction extends Model
{
    use HasFactory, HasShortflakePrimary;

    protected $fillable = [
        'or',
        'agent_id',
        'client_id',
        'staff_id',
        'plan_details_id',
        'pay_type_id',
        'amount'
    ];
}
