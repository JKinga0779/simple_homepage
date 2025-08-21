@extends('layouts.app')

@section('content')
<div style="{{'background-color:' . $companyinfo['site_background_color']}}">
    
    <div class="main_header">
        <div class="main_title">
            <h1>商品詳細</h1>
        </div>
        <div id="carousel_top_01" class="carousel slide carousel-fade main_c" data-bs-ride="carousel" style="z-index:1;">
            <div class="carousel-inner carousel_top">
                <div class="carousel-item carousel_top_img active">
                <img src="/storage/test01.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item carousel_top_img">
                <img src="/storage/test02.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item carousel_top_img">
                <img src="/storage/test_bg01.png" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>        
    </div>

    <div class="productinfo">
    
        <div class="productinfo_all">
            <a href="\">
                <div class="productinfo_cover" style="background-image: url(/storage/test08.png);">

                    <div class="productinfo_name" >productinfo</div>      
                </div>      
            </a>
            <a href="\">
                <div class="productinfo_cover" style="background-image: url(/storage/test_bg01.png);">

                
                <div class="productinfo_name" >productinfo TIPE</div>        
                </div>      
            </a>
            <a href="\">
                <div class="productinfo_cover" style="background-image: url(/storage/test11.png);">

                <div class="productinfo_name" >productinfo TIPE</div>           
                </div>      
            </a>
            <a href="\">
                <div class="productinfo_cover" style="background-image: url(/storage/test01.png);">

                <div class="productinfo_name" >productinfo TIPE</div>           
                </div>      
            </a>
            <a href="\">
                <div class="productinfo_cover" style="background-image: url(/storage/test09.png);">

                <div class="productinfo_name" >productinfo TIPE</div>           
                </div>      
            </a>
        </div>

    </div>
    
</div>



@endsection
