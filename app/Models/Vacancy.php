<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'department',
        'location',
        'employment_type',
        'salary_from',
        'salary_to',
        'requirements',
        'responsibilities',
        'status',
        'posting_date',
        'closing_date',
        'hiring_manager_id',
    ];

    protected $casts = [
        'posting_date' => 'date',
        'closing_date' => 'date',
        'salary_from' => 'decimal:2',
        'salary_to' => 'decimal:2',
        'requirements' => 'array',
        'responsibilities' => 'array',
    ];

    public function hiringManager()
    {
        return $this->belongsTo(User::class, 'hiring_manager_id');
    }
}
