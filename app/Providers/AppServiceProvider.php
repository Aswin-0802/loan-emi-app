<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\LoanDetailRepositoryInterface;
use App\Repositories\LoanDetailRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoanDetailRepositoryInterface::class, LoanDetailRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
