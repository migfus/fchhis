<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Kra8\Snowflake\HasShortflakePrimary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasShortflakePrimary;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'region_id',
        'branch_id',
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
}
