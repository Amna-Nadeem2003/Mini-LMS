<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // IMPORTANT: Define fields that can be mass-assigned
    protected $fillable = [
        'title',
        'description',
        'code',
        'credits',
        'user_id'  // ← Make sure this is here!
    ];

    // Define relationship: A course belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}