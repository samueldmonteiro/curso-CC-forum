<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use voku\helper\AntiXSS;

class Answer extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    private function checkContent(string $content): string
    {
        $xss = new AntiXSS();

        if ($xss->isXssFound($content)) {
            $xss->removeEvilAttributes(array('style'));
            $content = $xss->xss_clean($content);
        }

        return $content;
    }

    protected function content(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $this->checkContent($value)
        );
    }
}
