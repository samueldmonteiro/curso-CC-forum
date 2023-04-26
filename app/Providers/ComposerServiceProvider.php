<?php

namespace App\Providers;

use App\Models\Matter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewView;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('master.master', function (ViewView $view) {
            $view->with('currentUser', auth()->user());
            $view->with('matters', Matter::all());
        });
    }
}
