<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class LocalDBServiceProvider extends ServiceProvider
{
    /* Checking for local db file and creating one if doesnt exists */
    public function boot()
    {
        if((App::environment('local')) && (env('DB_CONNECTION') == 'sqlite')) {
            $databaseFile = database_path('database.sqlite');
            if (!file_exists($databaseFile)) {
                file_put_contents(database_path('database.sqlite'), '');
            }
        }
        
    }
}
