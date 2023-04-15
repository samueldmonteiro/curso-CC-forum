<?php

namespace App\Support;

use CoffeeCode\Cropper\Cropper as CoffeeCropper;

class Cropper
{
    protected static $CACHE_PATH = 'cache';

    public static function thumb(string $image, int $width, ?int $heigth = null): ?string
    {

        $c = new CoffeeCropper(config('filesystems.disks.public.root') . "/" . static::$CACHE_PATH);

        $path = config('filesystems.disks.public.root') . "/{$image}";
        if (!file_exists($path)) {
            $path = public_path($image);
        }

        if (!file_exists($path)) {
            $path = $image;
        }

        $local = $c->make($path, $width, $heigth);
        $local = static::$CACHE_PATH . "/" . collect(explode('/', $local))->last();
        return $local;
    }
}
