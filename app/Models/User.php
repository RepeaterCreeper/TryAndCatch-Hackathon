<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'roles_id',
        'status',
        'tag_id',
        'last_name',
        'birthdate',
        'address',
        'valid_id',
        'phone_number',
        'email',
        'password',
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function notif()
    {
        return $this->hasMany(Notification::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function document()
    {
        return $this->hasMany(Document::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

}
