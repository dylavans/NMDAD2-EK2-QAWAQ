<?php

namespace App;

use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationships
    // =============
    /**
     * One-to-Many
     *
     * @return HasMany
     */
    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
