<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id', 
        'title', 
        'description', 
        'due_date', 
        'status',
    ];
    
    // Convert due_date to a Carbon instance for easier date/time handling
    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
