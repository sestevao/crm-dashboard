<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'due_date',
        'priority',
        'status',
        'assigned_to',
        'estimate',
        'spent_time',
    ];

    protected $casts = [
        'is_backlog' => 'boolean',
        'due_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function formatHoursToDaysHours($hours)
    {
        if (!$hours) return '0h';
        $days = floor($hours / 8); // assuming 8 working hours per day
        $hrs = $hours % 8;

        $result = '';
        if ($days > 0) {
            $result .= $days . 'd';
        }
        if ($hrs > 0) {
            $result .= ($days > 0 ? ' ' : '') . $hrs . 'h';
        }
        return $result ?: '0h';
    }
}
