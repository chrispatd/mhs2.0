<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;   // Pastikan ini ada
use Illuminate\Support\Facades\Schema;  // Pastikan ini ada
use App\Models\MsMenu;                // Pastikan ini ada

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
        // Cek jika tabel ms_menu sudah ada untuk menghindari error
        if (Schema::hasTable('ms_menu')) {
            // Mengirim data menu ke view sidebar setiap kali view tersebut dirender
            View::composer('components.layouts.app.sidebar', function ($view) {
                $view->with('dynamicMenus', MsMenu::orderBy('order', 'asc')->get());
            });
        }
    }
}
