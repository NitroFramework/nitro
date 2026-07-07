<?php
// app/Models/User.php

namespace App\Models;

use Nitro\Auth\Concerns\Authenticatable;
use Nitro\Auth\Concerns\MustVerifyEmail as MustVerifyEmailTrait;
use Nitro\Auth\Contracts\Authenticatable as AuthenticatableContract;
use Nitro\Auth\Contracts\MustVerifyEmail as MustVerifyEmailContract;
use Nitro\Database\Factory\HasFactory;
use Nitro\Database\Model\BaseModel;
use Nitro\Notifications\Notifiable;

class User extends BaseModel implements AuthenticatableContract, MustVerifyEmailContract
{
    use HasFactory;
    use Authenticatable;
    use MustVerifyEmailTrait;
    use Notifiable;

    protected string $table = 'users';

    protected array $fillable = [
        'name',
        'email',
        'password',
        'status',
        'email_verified_at',
    ];

    protected array $hidden = [
        'password'
    ];

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
