<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\Destination; 
use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Support\Facades\Gate;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });
        
        View::composer('layouts.app', function ($view) {
            
            // Ambil gambar dari destinasi (sama seperti logika di Home sebelumnya)
            $galleryImages = Destination::with('images')
                ->where('status', 'active')
                ->get()
                ->pluck('images')
                ->flatten()
                ->take(8);
                
            $view->with('galleryImages', $galleryImages);
            $view->with('galleries', Gallery::latest()->take(8)->get());
        });
    }

    public function isAdmin() 
    {
        return $this->role === 'admin' || $this->role === 'superadmin';
    }

    public function isSuperAdmin() 
    {
        return $this->role === 'superadmin';
    }
}
