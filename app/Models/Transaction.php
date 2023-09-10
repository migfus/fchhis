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

    public function plan_details() {
        return $this->belongsTo(PlanDetail::class);
    }

    public function pay_type() {
        return $this->belongsTo(PayType::class);
    }

    public function agent() {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
