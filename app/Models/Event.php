<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Event extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'event_category_id',
        'title',
        'start',
        'end',
    ];

    public function EventCategory() {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }
}
