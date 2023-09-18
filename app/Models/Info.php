<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Info extends Model
{
    use HasFactory, HasShortflakePrimary;

    protected $fillable = [
        'user_id', 'staff_id', 'agent_id', 'bday', 'bplace_id', 'sex', 'address_id', 'address',
        'pay_type_id', 'plan_details_id', 'due_at', 'cell', 'or'
    ];

    public function user() {
        return $this->belongsTo(Info::class);
    }

    public function plan_detail() {
        return $this->belongsTo(PlanDetail::class);
    }
}
