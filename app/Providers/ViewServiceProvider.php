<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Image;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // แชร์ตัวแปร images ให้กับทุก view
        View::share('images', Image::all());
    }

    public function register()
    {
        //
    }
}