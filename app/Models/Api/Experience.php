<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'identifier', 
        'address', 
        'exp_banner', 
        'title', 
        'lat', 
        'lng', 
        'rating', 
        'description', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
