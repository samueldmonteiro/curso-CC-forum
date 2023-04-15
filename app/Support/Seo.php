<?php

namespace App\Support;

use CoffeeCode\Optimizer\Optimizer;

class Seo
{
    private Optimizer $optimizer;

    public function __construct()
    {
        $this->optimizer = new Optimizer();

        $this->optimizer->openGraph(
            env('APP_NAME')
        );
    }

    public function render(string $title, string $description, string $url, string $image, bool $follow = true): string
    {
        return $this->optimizer->optimize(
            $title,
            $description,
            $url,
            $image,
            $follow
        )->render();
    }
}
