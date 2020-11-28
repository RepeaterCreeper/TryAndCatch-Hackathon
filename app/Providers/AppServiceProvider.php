<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Might cause an error later, remove first before running php migration
        $notifs = Notification::where(['status'=>true])->orderBy('created_at','desc')->limit(2)->get();
        view()->share('notifs',$notifs);
    }
}
