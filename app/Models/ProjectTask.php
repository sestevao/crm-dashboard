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

    public function attachments()
    {
        return $this->hasMany(ProjectTaskAttachment::class);
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

    public function getStatusAttribute($value)
    {
        return ucwords(str_replace('_', ' ', $value));
    }

    public function getStatusClassesAttribute()
    {
        $status = strtolower($this->status);

        return match($this->status) {
            'completed'   => 'bg-green-50 dark:bg-green-900 text-green-500 dark:text-green-300',
            'in_progress' => 'bg-yellow-50 dark:bg-yellow-900 text-yellow-500 dark:text-yellow-300',
            'review'      => 'bg-blue-50 dark:bg-blue-900 text-blue-500 dark:text-blue-300',
            'to_do'        => 'bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-300',
            default       => 'bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-300',
        };
    }

}
