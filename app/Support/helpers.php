<?php

use App\Support\Cropper;
use App\Support\Message;

if (!function_exists('thumb')) {

    function thumb(string $image, int $width, ?int $heigth = null): ?string
    {
        return Cropper::thumb($image, $width, $heigth);
    }
}

if (!function_exists('message')) {

    function message(): Message
    {
        return new Message();
    }
}

if (!function_exists('is_email')) {

    function is_email(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
