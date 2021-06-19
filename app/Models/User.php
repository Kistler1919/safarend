<?php

namespace App\Models;

use App\Models\Api\Post;
use App\Models\Api\House;
use App\Models\Api\Status;
use App\Models\Api\Activity;
use App\Models\Api\Experience;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'user_identifier'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function status()
    {
        return $this->hasMany(Status::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    
    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'user_friends', 'user_id', 'friend_id');
    }

    public function toArray()
    {
        return [
            'identifier' => $this->user_identifier,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'friends' => $this->friends,
            'statuses' => $this->status,
            'posts' => $this->posts,
            'houses' => $this->houses,
            'experiences' => $this->experiences,
            'activities' => $this->activities,
        ];
    }
}
