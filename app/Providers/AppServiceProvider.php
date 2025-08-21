<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Companyinfo;
use App\Models\Header_image;

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
        view()->composer('*', function ($view) {

            $headerModel = new Header_image();
            $header_images = $headerModel->get();

            if(empty($header_images)){
                $header_images_count = 0;            
            }else{
                $header_images_count = count($header_images);
            }

            $companyinfoModel = new Companyinfo();
            $companyinfo = $companyinfoModel->first();
            if($companyinfo['nav_color']==1){
                $companyinfo['nav_color_class'] = "navbar-light bg-light";        
            }else if($companyinfo['nav_color']==2){
                $companyinfo['nav_color_class'] = "navbar-dark bg-dark";
            }
            // dd($companyinfo);
            
            $view->with('companyinfo', $companyinfo)->with('header_images', $header_images)->with('header_images_count', $header_images_count);
        });
    }
}
