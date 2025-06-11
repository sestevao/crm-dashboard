<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar_url',
        'password',
        'position',
        'department',
        'phone',
        'avatar',
        'bio',
        'skills',
        'birth_date',
        'hire_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'skills' => 'array',
        'birth_date' => 'date',
        'hire_date' => 'date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function projects()
    {
        return $this->belongsToMany(Project::class)
            ->using(ProjectUser::class)
            ->withPivot('role', 'status', 'progress')
            ->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(ProjectTask::class, 'assigned_to');
    }

    public function managedVacancies()
    {
        return $this->hasMany(Vacancy::class, 'hiring_manager_id');
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_user')
            ->withPivot('last_read_at')
            ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'uploaded_by');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_user')
            ->withTimestamps();
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_users')
            ->withTimestamps();
    }
}
