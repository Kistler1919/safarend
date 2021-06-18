<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'user_id', 
        'identifier', 
        'description', 
        'image_url', 
        'type', 
        'price', 
        'discountPrice',
        'totalPrice',
        'bedrooms',
        'beds',
        'address',
        'lat',
        'lng'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toArray()
    {
        return [
            'user_id' => $this->user_id,
            'identifier' => $this->identifer,
            'title' => $this->title,
            'description' => $this->description,
            'discountPrice' => $this->discountPrice,
            'totalPrice' => $this->totalPrice,
            'bedrooms' => $this->bedrooms,
            'beds' => $this->beds,
            'price' => $this->price,
            'image_url' => $this->image_url,
            'type' => $this->type,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,

        ];
    }
}
