<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'start_date',
        'deadline',
        'status',
        'manager_id',
        'budget',
        'progress',
        'team_members',
    ];

    protected $casts = [
        'start_date' => 'date',
        'deadline' => 'date',
        'budget' => 'decimal:2',
        'progress' => 'integer',
        'team_members' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class)
            ->using(ProjectUser::class)
            ->withPivot('role', 'status', 'progress')
            ->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(ProjectTask::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y');
    }
}
