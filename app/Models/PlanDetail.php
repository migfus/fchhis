<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PlanDetail extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'plan_id',
        'user_id',
        'age_start',
        'age_end',
        'desc',
        'contract_price',
        'spot_pay',
        'spot_service',
        'annual',
        'semi_annual',
        'querterly',
        'monthly',
    ];

    public function plan() {
        return $this->belongsTo(Plan::class);
    }
}
