<?php

namespace App\Http\Controllers;

use App\Support\Seo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected Seo $seo;

    public function __construct()
    {
        $this->seo = new Seo();
    }
}
