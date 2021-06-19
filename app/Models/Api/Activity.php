<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'identifier', 
        'venue', 
        'thumbnail', 
        'type', 
        'price', 
        'date', 
        'start_time', 
        'end_time', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
