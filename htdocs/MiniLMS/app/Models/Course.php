<?php

namespace App\Models;

// app/Models/Course.php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Import the User model

class Course extends Model
{
    use HasFactory;

    // IMPORTANT: Define fields that can be mass-assigned (required for store/update)
    protected $fillable = [
        'title',
        'description',
        'code',
        'credits',
        'user_id' // Important for creation when not using the relationship method
    ];

    // Define relationship: A course belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}