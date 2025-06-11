<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'uploaded_by',
        'category_id',
        'access_roles',
    ];

    protected $casts = [
        'access_roles' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'document_role')
            ->withTimestamps();
    }
}
