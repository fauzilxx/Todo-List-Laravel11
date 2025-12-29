<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    protected $fillable = [
        'title',
        'completed',
        'type',
        'urgency',
        'deadline',
        'description',
        'tags',
        'user_id'
    ];

    protected $casts = [
        'completed' => 'boolean',
        'deadline' => 'date',
        'tags' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('completed', false);
    }

    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    public function scopeOverdue($query)
    {
        return $query->where('completed', false)
            ->whereNotNull('deadline')
            ->whereDate('deadline', '<', now());
    }

    public function scopeToday($query)
    {
        return $query->whereDate('deadline', now()->toDateString());
    }

    public function getFormattedDeadlineAttribute()
    {
        if (!$this->deadline) {
            return null;
        }
        return $this->deadline->format('d M Y');
    }

    public function getIsOverdueAttribute()
    {
        if (!$this->deadline || $this->completed) {
            return false;
        }
        return $this->deadline->isPast();
    }
}
