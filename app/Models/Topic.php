<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'uri',
        'content'
    ];

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    private function randomString(int $size)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $size; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }

    public function generateUri(int $size = 8): string
    {
        $uri = $this->randomString($size);

        while (Topic::where('uri', $uri)->first()) {
            $uri = $this->randomString($size);
        }

        $this->uri = $uri;
        return $uri;
    }

    public function stateToggle(): void
    {
        if ($this->state) {
            $this->state = false;
        } else {
            $this->state = true;
        }

        $this->save();
    }
}
