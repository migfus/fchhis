<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Kra8\Snowflake\HasShortflakePrimary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasShortflakePrimary;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'area_region_id',
        'area_branch_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info() {
        return $this->hasOne(Info::class);
    }

    public function region() {
        return $this->belongsTo(Region::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function logs() {
        return $this->hasMany(Log::class);
    }

    public function client_transactions() {
        return $this->hasMany(Transaction::class, 'client_id');
    }

    public function agent_transactions() {
        return $this->hasMany(Transaction::class, 'agent_id');
    }

    public function agent_transactions_current_month() {
        return $this->agent_transactions()->where('created_at', '>=', Carbon::now()->startOfMonth())->where('created_at', '<=', Carbon::now()->endOfMonth());
    }

    public function staff_transactions() {
        return $this->hasMany(Transaction::class, 'staff_id');
    }

    public function beneficiaries() {
        return $this->hasMany(Beneficiary::class);
    }

    public function agent_client() {
        return $this->hasMany(Info::class, 'agent_id');
    }
}
