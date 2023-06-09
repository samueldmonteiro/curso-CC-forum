<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'shift',
        'period'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }


    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => !$value ? 'avatars/avatar.png' : $value
        );
    }

    public function likeThisAnswer(int $answerId)
    {
        if (
            AnswerLike::where('answer_id', $answerId)
            ->where('user_id', $this->id)
            ->first()
        ) {
            return true;
        }
        return false;
    }

    public function allLikesReceived()
    {
        $likes = 0;

        foreach ($this->answers()->get() as $answer) {
            $likes += $answer->likes()->count();
        };

        return $likes;
    }
}
