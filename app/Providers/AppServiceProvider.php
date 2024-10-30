<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\Image;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    public function boot()
    {
        Blade::directive('images', function () {
            return '<?php echo json_encode(\App\Models\Image::all()); ?>';
});
}

/**
* Bootstrap any application services.
*/
}
