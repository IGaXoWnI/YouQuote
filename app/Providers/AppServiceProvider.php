<?php

namespace App\Providers;

use App\Models\Citation;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Gate::define("delete_citation" , function(User $user , Citation $citation){
            return $user->id === $citation->user_id ;
        } );

        

      
        Gate::define("update_citation", function(User $user, Citation $citation) {
            return $user->id === $citation->user_id || $user->role === 'admin';
        });
    }
}
