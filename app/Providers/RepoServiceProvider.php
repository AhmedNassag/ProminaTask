<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /*** start basic data ***/
        //Base
        $this->app->bind(
            'App\Repositories\BaseRepository',
        );

        //Album
        $this->app->bind(
            'App\Repositories\Album\AlbumInterface',
            'App\Repositories\Album\AlbumRepository',
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
