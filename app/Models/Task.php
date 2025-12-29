<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    protected $fillable = [
        'title',
        'is_done',
        'type',
        'urgency',
        'deadline',
        'description',
        'tags'
    ];

    protected $casts = [
        'is_done' => 'boolean',
        'deadline' => 'date',
        'tags' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_done', false);
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_done', true);
    }

    public function scopeOverdue($query)
    {
        return $query->where('is_done', false)
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
        if (!$this->deadline || $this->is_done) {
            return false;
        }
        return $this->deadline->isPast();
    }
}
