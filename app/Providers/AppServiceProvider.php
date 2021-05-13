<?php

namespace App\Providers;

use App\Models\Author;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local') && class_exists('\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider')) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::share('globalName', 'global gesetzter Wert');
        View::share('authorOptions', Author::options());
        View::share('currentTimestamp', Carbon::now()->timestamp);
        View::share('authorOptions', Author::options());
        Builder::macro('toRawSql', function() {
            $sql = str_replace('?', "'%s'", $this->toSql());
            $sql = vsprintf($sql, $this->getBindings());
            dd($sql);
        });

        /*
         * set https protocol, if environment is not local
                if(!$this->app->environment('local')) {
                    URL::forceScheme('https');
                }
        */
    }
}
