<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_role')
            ->withTimestamps();
    }
}
