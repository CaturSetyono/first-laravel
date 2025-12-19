<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Asset version for cache busting
     */
    private const ASSET_VERSION = '1.0.3';
    
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
        // Share admin assets version globally
        View::share('assetVersion', self::ASSET_VERSION);
        
        // Share admin assets globally to all views
        View::composer('adminlte::page', function ($view) {
            $view->with('adminProAssets', true);
        });
        
        // Custom Blade directive for optimized loading with versioning
        Blade::directive('adminProStyles', function () {
            $version = self::ASSET_VERSION;
            return "<?php echo '<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">' .
                   '<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>' .
                   '<link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap\" rel=\"stylesheet\">' .
                   '<link rel=\"stylesheet\" href=\"' . asset('css/admin-pro.css') . '?v={$version}\">' .
                   '<link rel=\"stylesheet\" href=\"' . asset('css/preloader.css') . '?v={$version}\">'
            ; ?>";
        });
        
        Blade::directive('adminProScripts', function () {
            $version = self::ASSET_VERSION;
            return "<?php echo '<script src=\"' . asset('js/admin-pro.js') . '?v={$version}\" defer></script>'; ?>";
        });
    }
}
