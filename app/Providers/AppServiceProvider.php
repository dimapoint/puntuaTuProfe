<?php

namespace App\Providers;

use App\Events\ReviewCreated;
use App\Listeners\InvalidateTeacherStatsCache;
use App\Listeners\LinkTeacherToCourse;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            ReviewCreated::class,
            [InvalidateTeacherStatsCache::class, 'handle']
        );

        Event::listen(
            ReviewCreated::class,
            [LinkTeacherToCourse::class, 'handle']
        );
    }
}
