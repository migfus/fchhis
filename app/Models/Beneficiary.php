<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Beneficiary extends Model
{
  use HasFactory, HasUuids;

  protected $fillable = [
    'user_id',
    'staff_id',
    'name',
    'bday'
  ];
}
